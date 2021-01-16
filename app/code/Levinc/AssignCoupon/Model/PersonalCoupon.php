<?php

namespace Levinc\AssignCoupon\Model;

class PersonalCoupon extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'levinc_assignCoupon_personal';

    protected $_cacheTag = 'levinc_assignCoupon_personal';

    protected $_eventPrefix = 'levinc_assignCoupon_personal';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('Levinc\AssignCoupon\Model\ResourceModel\PersonalCoupon');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
