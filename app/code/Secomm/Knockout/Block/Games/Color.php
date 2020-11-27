<?php
namespace Secomm\Knockout\Block\Games;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class Color extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    public function __construct(ScopeConfigInterface $scopeConfig, Template\Context $context, array $data = [])
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getIsActive()
    {
        return $this->scopeConfig->getValue(
            'knockout/components/active',
            ScopeInterface::SCOPE_STORE
        );
    }
}
