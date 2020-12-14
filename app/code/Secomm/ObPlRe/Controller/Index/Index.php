<?php
namespace Secomm\ObPlRe\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $title;
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo $this->setTitle('Demo');

        $textDisplay = new \Magento\Framework\DataObject(array('text' => $this->getTitle()));
        $this->_eventManager->dispatch('demo_event_display_text', ['text' => $textDisplay]);
        echo $textDisplay->getText();
        exit;
    }

    public function setTitle($title)
    {
        return $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
