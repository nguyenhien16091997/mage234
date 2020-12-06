<?php
namespace Secomm\DependencyInjection\Block\Analyze;

use Magento\Framework\View\Element\Template;

class Table extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'Secomm_DependencyInjection::analyze/table.phtml';

    protected $data = [
        ['com1', '249 la xuan oai', '27-01-2020','5000', '7000'],
        ['com2', '249 la xuan oai', '27-01-2020','5000', '7000'],
        ['com3', '249 la xuan oai', '27-01-2020','5000', '7000'],
        ['com4', '249 la xuan oai', '27-01-2020','5000', '7000']
    ];

    protected $displayableColumns = [];
    protected $tableTitle = "Default table title";

    protected $columnMap = [
        'name' => 'Name',
        'address' => 'Address',
        'created_date' => 'Create At',
        'last_year_profit' => 'Last Year Profit',
        'this_year_profit' => 'This Year Profit'
    ];

    protected $columnIndex = [
        'name' => 0,
        'address' => 1,
        'created_date' => 2,
        'last_year_profit' => 3,
        'this_year_profit' => 4
    ];

    public function __construct(
        Template\Context $context,
        string $tableTitle = '',
        array $displayableColumns = [],
        array $data = []
    ) {
        $this->displayableColumns = $displayableColumns;
        $this->tableTitle = $tableTitle;
        parent::__construct($context, $data);
    }

    public function getTableHeader()
    {
        $headers = [];
        foreach ($this->displayableColumns as $column) {
            $headers[] = $this->columnMap[$column];
        }
        return $headers;
    }

    public function getTableData()
    {
        $table = [];
        foreach ($this->data as $datarow) {
            $displayData = [];
            foreach ($this->displayableColumns as $column){
                $index = $this->columnIndex[$column];
                $displayData[] = $datarow[$index];
            }
            $tableData[] = $displayData;
        }
        return count($tableData) > 0 ? $tableData : null;
    }

    public function getTableTitle()
    {
        return $this->tableTitle;
    }

    public function setTableTitle($title)
    {
        $this->tableTitle = $title;
    }

    public function formatNumer($numner)
    {
        return '$' . number_format($numner, 2, '.', ',');
    }
}
