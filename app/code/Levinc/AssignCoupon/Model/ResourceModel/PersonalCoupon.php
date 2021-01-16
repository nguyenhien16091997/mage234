<?php

namespace Levinc\AssignCoupon\Model\ResourceModel;

use Magento\Framework\App\ResourceConnection;
use Levinc\AssignCoupon\Setup\InstallSchema;

class PersonalCoupon extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Widget constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(InstallSchema::TABLE_NAME, 'id');
    }
}
