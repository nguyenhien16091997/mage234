<?php
namespace Levinc\AssignCoupon\Controller\Adminhtml\Assign;

class Index extends \Levinc\AssignCoupon\Controller\Adminhtml\Assign
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Personal Coupon')));

        return $resultPage;
    }
}
