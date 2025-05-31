<?php
/**
 * Copyright © author: Yan Rodrigues Rocha All rights reserved.
 */
declare(strict_types=1);

namespace Hibrido\MetaTagMultiSite\Service;

use Magento\Framework\App\Config\ScopeConfigInterface;

class MetaTagMultiSiteConfiguration
{
    const string METATAG = 'metatag/';
    const string CONFIGURATION = 'configuration/';
    const string ENABLED = 'enabled';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param $storeId
     *
     * @return bool
     */
    public function isEnabled($storeId): bool
    {
        $defaultConfig = $this->scopeConfig->isSetFlag(self::METATAG . self::CONFIGURATION . self::ENABLED);
        $storeConfig = $this->scopeConfig->isSetFlag(
            self::METATAG . self::CONFIGURATION . self::ENABLED,
            'store',
            $storeId
        );

        return $defaultConfig || $storeConfig;
    }
}
