<?php
/**
 * Copyright © author: Yan Rodrigues Rocha All rights reserved.
 */
declare(strict_types=1);

namespace Hibrido\MetaTagMultiSite\Block;

use Hibrido\MetaTagMultiSite\Service\MetaTagMultiSiteConfiguration;
use Magento\Cms\Model\Page;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManager;

class MetaTagMultiSite extends Template
{

    private int $cmsPageId;
    private string $cmsUrlKey;
    private array $cmsPageStores;
    private bool $isCmsPage = false;

    /**
     * @var Page
     */
    private Page $page;

    /**
     * @var StoreManager
     */
    private StoreManager $storeManager;

    /**
     * @var MetaTagMultiSiteConfiguration
     */
    private MetaTagMultiSiteConfiguration $metaTagMultiSiteConfiguration;

    /**
     * Constructor
     *
     * @param Page $page
     * @param StoreManager $storeManager
     * @param MetaTagMultiSiteConfiguration $metaTagMultiSiteConfiguration
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Page $page,
        StoreManager $storeManager,
        MetaTagMultiSiteConfiguration $metaTagMultiSiteConfiguration,
        Template\Context $context,
        array $data = []
    ) {
        $this->page = $page;
        $this->storeManager = $storeManager;
        $this->metaTagMultiSiteConfiguration = $metaTagMultiSiteConfiguration;
        if ($context->getRequest()->getModuleName() == 'cms') {
            $this->isCmsPage = true;
            $this->cmsPageId = (int)$page->getId();
            $this->cmsUrlKey = $context->getRequest()->getOriginalPathInfo();
            $this->cmsPageStores = $page->getStores();
        }

        parent::__construct($context, $data);
    }

    /**
     * @return bool
     * @throws NoSuchEntityException
     */
    public function getModuleIsEnabled(): bool
    {
        return $this->metaTagMultiSiteConfiguration->isEnabled($this->storeManager->getStore()->getId());
    }

    /**
     * @return bool
     */
    public function getIsCmsPage(): bool
    {
        return $this->isCmsPage;
    }

    /**
     * @return string
     */
    public function getCmsUrlKey(): string
    {
        return $this->cmsUrlKey;
    }

    /**
     * @return array
     */
    public function getCmsPageStores(): array
    {
        return $this->cmsPageStores;
    }

    /**
     * @return array
     */
    public function getStores(): array
    {
        return $this->storeManager->getStores(true);
    }

}
