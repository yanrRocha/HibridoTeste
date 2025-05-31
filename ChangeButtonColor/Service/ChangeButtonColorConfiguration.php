<?php
/**
 * Copyright © author: Yan Rodrigues Rocha All rights reserved.
 */
declare(strict_types=1);

namespace Hibrido\ChangeButtonColor\Service;

use Magento\Config\Model\ResourceModel\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ChangeButtonColorConfiguration
{
    const string BUTTONCOLOR = 'buttoncolor/';
    const string CONFIGURATION = 'configuration/';
    const string ENABLED = 'enabled';
    const string COLOR = 'color';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @var Config
     */
    private Config $configResource;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param Config $configResource
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Config $configResource
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->configResource = $configResource;
    }

    /**
    * Get is enabled config
    * @param mixed $storeId
    *
    * @return bool
    */
    public function isEnabled($storeId): bool
    {
        $defaultConfig = $this->scopeConfig->isSetFlag(self::BUTTONCOLOR . self::CONFIGURATION . self::ENABLED);
        $storeConfig = $this->scopeConfig->getValue(
            self::BUTTONCOLOR . self::CONFIGURATION . self::ENABLED,
            'store',
            $storeId
        );

        return $defaultConfig || $storeConfig;
    }

    /**
     * @param int $enabled
     * @param $storeId
     * @return void
     */
    public function setIsEnabled(int $enabled, $storeId): void
    {
        $this->configResource->saveConfig(
            self::BUTTONCOLOR . self::CONFIGURATION . self::ENABLED,
            $enabled,
            'stores',
            $storeId
        );
    }

    /**
     * @param mixed $storeId
     *
     * @return string
     */
    public function getColor(mixed $storeId): string
    {
        return $this->scopeConfig->getValue(
            self::BUTTONCOLOR . self::CONFIGURATION . self::COLOR,
            'store',
            $storeId
        ) ?? "#000000";
    }

    /**
     * @param $color
     * @param $storeId
     *
     * @return void
     */
    public function setColor($color, $storeId): void
    {
        $this->configResource->saveConfig(
            self::BUTTONCOLOR . self::CONFIGURATION . self::COLOR,
            '#' . $color,
            'stores',
            $storeId
        );
    }

}
