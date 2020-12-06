<?php
namespace Secomm\DependencyInjection\Block\Analyze;

use Magento\Framework\View\Element\Template;

class Dashboard extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Secomm\DependencyInjection\Block\Analyze\ChartInterface
     */
    protected $chartInterface;
    public function __construct(
        Template\Context $context,
        \Secomm\DependencyInjection\Block\Analyze\ChartInterface $chartInterface,
        array $data = []
    ) {
        $this->chartInterface = $chartInterface;
        parent::__construct($context, $data);
    }

    public function getCharts()
    {
        return $this->getData('charts');
    }

    public function renderCharts()
    {
        try {
            $html='';
            $chartIds = $this->getCharts();
            foreach ($chartIds as $chartId) {
                $chartClass = $this->chartInterface->getChartClass($chartId);
                $block = $this->getLayout()->createBlock($chartClass);
                $block->setChartId($chartId);
                $html .= $block->toHtml();
            }
            return $html;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
