<?php
/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * Please visit Magefan.com for license details (https://magefan.com/end-user-license-agreement).
 *
 * Glory to Ukraine! Glory to the heroes!
 */
namespace Magefan\Blog\Observer;

use Magefan\Blog\Model\Config;
use Magefan\Blog\Model\NoSlashUrlRedirect;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class PredispathFrontendBlogActionControllerObserver
 * @package Magefan\Blog\Observer
 */
class PredispathFrontendBlogActionControllerObserver implements ObserverInterface
{
    /**
     * @var NoSlashUrlRedirect
     */
    protected $noSlashUrlRedirect;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * PredispathFrontendBlogActionControllerObserver constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param NoSlashUrlRedirect $noSlashUrlRedirect
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        NoSlashUrlRedirect $noSlashUrlRedirect
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->noSlashUrlRedirect = $noSlashUrlRedirect;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $redirectToNoSlash = $this->scopeConfig->getValue(Config::XML_PATH_REDIRECT_TO_NO_SLASH, ScopeInterface::SCOPE_STORE);

        $advancedPermalinkEnabled =  $this->scopeConfig->getValue(Config::XML_PATH_ADVANCED_PERMALINK_ENABLED, ScopeInterface::SCOPE_STORE);

        if ($redirectToNoSlash && !$advancedPermalinkEnabled) {
            $this->noSlashUrlRedirect->execute($observer);
        }
    }
}
