<?php
namespace Secomm\DependencyInjection\Viewmodel\Analyze;

class Header implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function getTitle()
    {
        return 'Analyze Dashboard';
    }
}
