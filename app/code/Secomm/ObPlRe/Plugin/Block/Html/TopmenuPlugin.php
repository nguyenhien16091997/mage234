<?php

namespace Secomm\ObPlRe\Plugin\Block\Html;

class TopmenuPlugin extends \Magento\Framework\View\Element\Template
{
    public function afterGetMenu(\Magento\Theme\Block\Html\Topmenu $subject, $result)
    {
        /** @var \Magento\Framework\Data\Tree\Node $menu */
        $tree = $result->getTree();
        $data = [
            'name'      => __('Home'),
            'id'        => 'homepage',
            'url'       => $this->getBaseUrl()
        ];
        $node = new \Magento\Framework\Data\Tree\Node($data, 'id', $tree, $result);
        $result->addChild($node);
        return $result;
    }
}
