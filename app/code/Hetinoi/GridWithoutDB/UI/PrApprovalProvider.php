<?php

namespace KPIS\MarketPlaceExtend\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\Request\Http;

/**
 * Class ProductDataProvider
 */
class PrApprovalProvider extends AbstractDataProvider
{

    /**
     * @var \Magento\Ui\DataProvider\AddFieldToCollectionInterface[]
     */
    protected $addFieldStrategies;

    /**
     * @var \Magento\Ui\DataProvider\AddFilterToCollectionInterface[]
     */
    protected $addFilterStrategies;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * Construct
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Http $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->request = $request;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $items = [
            ['entity_id' => "10", 'account_name' => 'dddd'],
            ['entity_id' => "2", 'account_name' => 'dddd'],
            ['entity_id' => "3", 'account_name' => 'dddd'],
            ['entity_id' => "4", 'account_name' => 'dddd'],
            ['entity_id' => "5", 'account_name' => 'dddd'],
            ['entity_id' => "6", 'account_name' => 'dddd'],
            ['entity_id' => "7", 'account_name' => 'dddd'],
            ['entity_id' => "8", 'account_name' => 'dddd'],
            ['entity_id' => "9", 'account_name' => 'dddd'],
            ['entity_id' => "10", 'account_name' => 'dddd'],
            ['entity_id' => "11", 'account_name' => 'dddd'],
            ['entity_id' => "12", 'account_name' => 'dddd'],
            ['entity_id' => "13", 'account_name' => 'dddd'],
            ['entity_id' => "14", 'account_name' => 'dddd'],
            ['entity_id' => "15", 'account_name' => 'dddd'],
            ['entity_id' => "16", 'account_name' => 'dddd'],
            ['entity_id' => "17", 'account_name' => 'dddd'],
            ['entity_id' => "18", 'account_name' => 'dddd'],
            ['entity_id' => "19", 'account_name' => 'dddd'],
            ['entity_id' => "20", 'account_name' => 'dddd'],
            ['entity_id' => "21", 'account_name' => 'dddd'],
            ['entity_id' => "22", 'account_name' => 'dddd'],
            ['entity_id' => "23", 'account_name' => 'dddd'],
            ['entity_id' => "24", 'account_name' => 'dddd'],
            ['entity_id' => "25", 'account_name' => 'dddd'],
            ['entity_id' => "26", 'account_name' => 'dddd'],
            ['entity_id' => "27", 'account_name' => 'dddd'],
        ];

        $pagesize = intval($this->request->getParam('paging')['pageSize']);
        $pageCurrent = intval($this->request->getParam('paging')['current']);

        return [
            'totalRecords' => count($items),
            'items' => $items
        ];
    }

    // ###########################################

    public function setLimit($offset, $size)
    {
    }

    public function addOrder($field, $direction)
    {
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
    }
}