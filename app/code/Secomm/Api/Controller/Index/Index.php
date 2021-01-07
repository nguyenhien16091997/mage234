<?php
namespace Secomm\Api\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $title;
    protected $_pageFactory;
    protected $postFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Secomm\Api\Model\PostFactory $postFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->postFactory = $postFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->postFactory->create();
        $collection = $post->getCollection();
        foreach($collection as $item){
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
        exit();
        return $this->_pageFactory->create();
    }
}
