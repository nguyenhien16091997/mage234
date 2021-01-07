<?php
namespace Secomm\Api\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'secomm_api_post';

    protected $_cacheTag = 'secomm_api_post';

    protected $_eventPrefix = 'secomm_api_post';

    protected function _construct()
    {
        $this->_init('Secomm\Api\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
