<?php

namespace Secomm\ObPlRe\Observer;

class ChangeDisplayText implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $displayText = $observer->getData('text');
        echo $displayText->getText() . "</br>";
        $displayText->setText('Execute event successfully.');

        return $this;
    }
}
