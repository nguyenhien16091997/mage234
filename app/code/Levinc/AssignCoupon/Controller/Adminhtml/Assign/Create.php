<?php
namespace Levinc\AssignCoupon\Controller\Adminhtml\Assign;


class Create extends \Levinc\AssignCoupon\Controller\Adminhtml\Assign
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Assign Personal Coupon')));

        return $resultPage;
    }
}
