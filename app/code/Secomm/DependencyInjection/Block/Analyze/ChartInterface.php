<?php
namespace Secomm\DependencyInjection\Block\Analyze;

interface ChartInterface
{
    public function getChartClass($id);
    public function getChartType();
    public function getChartTile();
    public function setChartId($id);
}
