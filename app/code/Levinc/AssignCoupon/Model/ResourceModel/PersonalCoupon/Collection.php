<?php
namespace Levinc\AssignCoupon\Model\ResourceModel\PersonalCoupon;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'levinc_assignCoupon_personal_collection';
    protected $_eventObject = 'levinc_personal_coupon_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Levinc\AssignCoupon\Model\PersonalCoupon', 'Levinc\AssignCoupon\Model\ResourceModel\PersonalCoupon');
    }
}
