<?php

namespace Levinc\AssignCoupon\Plugin\Model;

use Magento\Framework\Exception\NoSuchEntityException;

class CouponManagement
{
    /**
     * @var \Levinc\AssignCoupon\Model\PersonalCouponFactory
     */
    protected $personalCouponFactory;

    /**
     * Quote repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;
    /**
     * @var \Magento\SalesRule\Model\Coupon
     */
    protected $coupon;

    protected $customerCoupon;
    /**
     * CouponManagement constructor.
     * @param \Levinc\AssignCoupon\Model\PersonalCouponFactory $personalCouponFactory
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     * @param \Magento\SalesRule\Model\Coupon $coupon
     * @param \Levinc\AssignCoupon\Helper\PersonalCoupon\Customers $customerCoupon
     */
    public function __construct(
        \Levinc\AssignCoupon\Model\PersonalCouponFactory $personalCouponFactory,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Magento\SalesRule\Model\Coupon $coupon,
        \Levinc\AssignCoupon\Helper\PersonalCoupon\Customers $customerCoupon
    ) {
        $this->personalCouponFactory = $personalCouponFactory;
        $this->quoteRepository = $quoteRepository;
        $this->coupon = $coupon;
        $this->customerCoupon = $customerCoupon;
    }

    public function beforeSet(\Magento\Quote\Model\CouponManagement $subject, $cartId, $couponCode)
    {
        /** @var  \Magento\Quote\Model\Quote $quote */
        $quote = $this->quoteRepository->getActive($cartId);

        $customerId = $quote->getCustomerId();
        $couponId = $this->coupon->loadByCode($couponCode)->getCouponId();

        // get customers coupons
        $personalCoupons = $this->customerCoupon->process($customerId, $couponId);

        if (count($personalCoupons) == 0) {
            throw new NoSuchEntityException(__("The coupon code couldn't be applied. Verify the coupon code and try again."));
        }
    }
}
