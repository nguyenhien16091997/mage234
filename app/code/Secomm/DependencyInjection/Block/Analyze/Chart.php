<?php
namespace Secomm\DependencyInjection\Block\Analyze;

class Chart extends \Magento\Framework\View\Element\Template implements \Secomm\DependencyInjection\Block\Analyze\ChartInterface
{
    protected $chartNames;
    protected $chartClasses;
    protected $chartId;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = [],
        array $chartClasses = [],
        array $chartNames = []
    ) {
        $this->chartClasses = $chartClasses;
        $this->chartNames = $chartNames;
        parent::__construct($context, $data);
    }

    public function getChartClass($id)
    {
        return $this->chartClasses[$id];
    }

    public function getChartType()
    {
        return $this->chartId;
    }

    public function getChartTile()
    {
        return $this->chartNames[$this->getChartType()];
    }

    public function setChartId($id)
    {
        return $this->chartId = $id;
    }
}
