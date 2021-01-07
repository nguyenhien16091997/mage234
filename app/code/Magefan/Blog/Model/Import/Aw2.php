<?php
/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * Please visit Magefan.com for license details (https://magefan.com/end-user-license-agreement).
 *
 * Glory to Ukraine! Glory to the heroes!
 */

namespace Magefan\Blog\Model\Import;

/**
 * Aw2 import model
 */
class Aw2 extends AbstractImport
{
    protected $_requiredFields = ['dbname', 'uname', 'dbhost'];

    public function execute()
    {
        $host = $this->getData('dbhost') ?: $this->getData('host');
        if (false !== strpos($host, '.sock')) {
            $con = $this->_connect = mysqli_connect(
                'localhost',
                $this->getData('uname'),
                $this->getData('pwd'),
                $this->getData('dbname'),
                null,
                $host
            );
        } else {
            $con = $this->_connect = mysqli_connect(
                $this->getData('dbhost'),
                $this->getData('uname'),
                $this->getData('pwd'),
                $this->getData('dbname')
            );
        }

        if (mysqli_connect_errno()) {
            throw new \Exception("Failed connect to magento database", 1);
        }

        mysqli_set_charset($con, "utf8");

        $_pref = mysqli_real_escape_string($con, $this->getData('prefix'));

        $sql = 'SELECT * FROM ' . $_pref . 'aw_blog_category LIMIT 1';
        try {
            $this->_mysqliQuery($sql);
        } catch (\Exception $e) {
            throw new \Exception(__('AheadWorks Blog Extension not detected.'), 1);
        }

        $storeIds = array_keys($this->_storeManager->getStores(true));

        $categories = [];
        $oldCategories = [];

        /* Import categories */
        $sql = 'SELECT
                    t.id as old_id,
                    t.name as title,
                    t.url_key as identifier,
                    t.sort_order as position,
                    t.meta_description as meta_description
                FROM ' . $_pref . 'aw_blog_category t';

        $result = $this->_mysqliQuery($sql);
        while ($data = mysqli_fetch_assoc($result)) {
            /* Prepare category data */

            /* Find store ids */
            $data['store_ids'] = [];
            $s_sql = 'SELECT store_id FROM ' . $_pref . 'aw_blog_category_store WHERE category_id = "' . $data['old_id'] . '"';
            $s_result = $this->_mysqliQuery($s_sql);
            while ($s_data = mysqli_fetch_assoc($s_result)) {
                $data['store_ids'][] = $s_data['store_id'];
            }

            foreach ($data['store_ids'] as $key => $id) {
                if (!in_array($id, $storeIds)) {
                    unset($data['store_ids'][$key]);
                }
            }

            if (empty($data['store_ids']) || in_array(0, $data['store_ids'])) {
                $data['store_ids'] = 0;
            }

            $data['is_active'] = 1;
            $data['path'] = 0;
            $data['identifier'] = trim(strtolower($data['identifier']));
            if (strlen($data['identifier']) == 1) {
                $data['identifier'] .= $data['identifier'];
            }

            $category = $this->_categoryFactory->create();
            try {
                /* Initial saving */
                $category->setData($data)->save();
                $this->_importedCategoriesCount++;
                $categories[$category->getId()] = $category;
                $oldCategories[$category->getOldId()] = $category;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                unset($category);
                $this->_skippedCategories[] = $data['title'];
                $this->_logger->addDebug('Blog Category Import [' . $data['title'] . ']: ' . $e->getMessage());
            }
        }

        /* Import tags */
        $tags = [];
        $oldTags = [];
        $existingTags = [];

        $sql = 'SELECT
                    t.id as old_id,
                    t.name as title
                FROM ' . $_pref . 'aw_blog_tag t';

        $result = $this->_mysqliQuery($sql);
        while ($data = mysqli_fetch_assoc($result)) {
            /* Prepare tag data */
            foreach (['title'] as $key) {
                $data[$key] = mb_convert_encoding($data[$key], 'HTML-ENTITIES', 'UTF-8');
            }

            if (!$data['title']) {
                continue;
            }

            $data['title'] = trim($data['title']);

            try {
                /* Initial saving */
                if (!isset($existingTags[$data['title']])) {
                    $tag = $this->_tagFactory->create();
                    $tag->setData($data)->save();
                    $this->_importedTagsCount++;
                    $tags[$tag->getId()] = $tag;
                    $oldTags[$tag->getOldId()] = $tag;
                    $existingTags[$tag->getTitle()] = $tag;
                } else {
                    $tag = $existingTags[$data['title']];
                    $oldTags[$data['old_id']] = $tag;
                }
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->_skippedTags[] = $data['title'];
                $this->_logger->addDebug('Blog Tag Import [' . $data['title'] . ']: ' . $e->getMessage());
            }
        }

        /* Import posts */
        $sql = 'SELECT * FROM ' . $_pref . 'aw_blog_post';
        $result = $this->_mysqliQuery($sql);

        while ($data = mysqli_fetch_assoc($result)) {
            /* Find post categories*/
            $postCategories = [];
            $c_sql = 'SELECT category_id FROM ' . $_pref . 'aw_blog_post_category WHERE post_id = "' . $data['id'] . '"';
            $c_result = $this->_mysqliQuery($c_sql);
            while ($c_data = mysqli_fetch_assoc($c_result)) {
                $oldId = $c_data['category_id'];
                if (isset($oldCategories[$oldId])) {
                    $id = $oldCategories[$oldId]->getId();
                    $postCategories[$id] = $id;
                }
            }

            /* Find store ids */
            $data['store_ids'] = [];
            $s_sql = 'SELECT store_id FROM ' . $_pref . 'aw_blog_post_store WHERE post_id = "' . $data['id'] . '"';
            $s_result = $this->_mysqliQuery($s_sql);
            while ($s_data = mysqli_fetch_assoc($s_result)) {
                $data['store_ids'][] = $s_data['store_id'];
            }

            foreach ($data['store_ids'] as $key => $id) {
                if (!in_array($id, $storeIds)) {
                    unset($data['store_ids'][$key]);
                }
            }

            if (empty($data['store_ids']) || in_array(0, $data['store_ids'])) {
                $data['store_ids'] = 0;
            }

            /* Prepare post data */
            $data = [
                'old_id' => $data['id'],
                'store_ids' => $data['store_ids'],
                'title' => $data['title'],
                'meta_description' => $data['meta_description'],
                'identifier' => $data['url_key'],
                'content_heading' => '',
                'content' => str_replace('<!--more-->', '<!-- pagebreak -->', $data['content']),
                'short_content' => $data['short_content'],
                'creation_time' => strtotime($data['created_at']),
                'update_time' => strtotime($data['updated_at']),
                'publish_time' => strtotime($data['publish_date']),
                'is_active' => (int)($data['status'] == 'publication'),
                'categories' => $postCategories,
                'featured_img' => !empty($data['featured_image']) ? 'magefan_blog/' . $data['featured_image'] : '',
            ];
            $data['identifier'] = trim(strtolower($data['identifier']));

            $post = $this->_postFactory->create();
            try {
                /* Post saving */
                $post->setData($data)->save();

                $this->_importedPostsCount++;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->_skippedPosts[] = $data['title'];
                $this->_logger->addDebug('Blog Post Import [' . $data['title'] . ']: ' . $e->getMessage());
            }

            unset($post);
        }
        /* end */

        mysqli_close($con);
    }
}
