<?php

namespace Levinc\AssignCoupon\Controller\Adminhtml;

class Assign extends \Magento\Backend\App\Action
{
    /**
     * @var bool|\Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory = false;
    /**
     * @var \Levinc\AssignCoupon\Model\PersonalCouponFactory
     */
    protected $personalCouponFactory;
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var \Magento\Framework\DB\TransactionFactory
     */
    protected $transactionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Levinc\AssignCoupon\Model\PersonalCouponFactory $personalCouponFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\DB\TransactionFactory $transactionFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->personalCouponFactory = $personalCouponFactory;
        $this->coreRegistry = $coreRegistry;
        $this->transactionFactory = $transactionFactory;
    }

    /**
     * @return \Magento\Framework\Registry
     */
    protected function getRegistry()
    {
        return $this->coreRegistry;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
    }
}
