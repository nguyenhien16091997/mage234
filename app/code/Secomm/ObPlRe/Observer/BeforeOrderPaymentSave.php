<?php

namespace Secomm\ObPlRe\Observer;

use Magento\Customer\Api\CustomerRepositoryInterface;

class BeforeOrderPaymentSave implements \Magento\Framework\Event\ObserverInterface
{
    private $customerRepository;

    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getData('order');

        if ($customerId = $order->getData('customer_id')) {
            if ($order->getData('grand_total') > 1000) {
                $customer = $this->customerRepository->getById($customerId);
                $customer->setGroupId(4);
                $this->customerRepository->save($customer);
            }
        }

        return $this;
    }
}
