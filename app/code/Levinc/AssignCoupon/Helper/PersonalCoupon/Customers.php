<?php
declare(strict_types=1);

namespace Levinc\AssignCoupon\Helper\PersonalCoupon;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Select;

/**
 * Base select processor.
 */
class Customers
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;
    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        $this->resourceConnection = $resourceConnection;
    }

    public function process($customerId, $couponId)
    {
        $resource = $this->resourceConnection;
        $connection = $resource->getConnection();
        $select = $connection->select()
            ->from(
                ['per' => 'levinc_personal_coupon']
            )
            ->where(sprintf('per.customer_id = ?'), $customerId)
            ->where(sprintf('per.coupon_id = ?'), $couponId);
        $data = $connection->fetchAll($select);
        return $data;
    }
}
