<?php

namespace Secomm\CustomDiscountRow\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class ConfigProvider implements ConfigProviderInterface
{
    protected function getCustomDiscoutValue(){
        return -22;
    }

    public function getConfig()
    {
        return [
            'CustomDiscountRow' => [
                'canDisplay' => true,
                'amount' => $this->getCustomDiscoutValue()
            ]
        ];
    }
}
