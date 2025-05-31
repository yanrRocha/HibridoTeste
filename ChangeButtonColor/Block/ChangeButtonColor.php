<?php
/**
 * Copyright © author: Yan Rodrigues Rocha All rights reserved.
 */
declare(strict_types=1);

namespace Hibrido\ChangeButtonColor\Block;

use Hibrido\ChangeButtonColor\Service\ChangeButtonColorConfiguration;
use Magento\Cms\Model\Page;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManager;

class ChangeButtonColor extends Template
{
    /**
     * @var Page
     */
    private Page $page;

    /**
     * @var StoreManager
     */
    private StoreManager $storeManager;

    /**
     * @var ChangeButtonColorConfiguration
     */
    private ChangeButtonColorConfiguration $buttonColorConfiguration;

    /**
     * Constructor
     *
     * @param Page $page
     * @param StoreManager $storeManager
     * @param ChangeButtonColorConfiguration $buttonColorConfiguration
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Page $page,
        StoreManager $storeManager,
        ChangeButtonColorConfiguration $buttonColorConfiguration,
        Template\Context $context,
        array $data = []
    ) {
        $this->page = $page;
        $this->storeManager = $storeManager;
        $this->buttonColorConfiguration = $buttonColorConfiguration;

        parent::__construct($context, $data);
    }

    /**
     * @return bool
     * @throws NoSuchEntityException
     */
    public function getModuleIsEnabled(): bool
    {
        return $this->buttonColorConfiguration->isEnabled($this->storeManager->getStore()->getId());
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getColor(): string
    {
        return $this->buttonColorConfiguration->getColor($this->storeManager->getStore()->getId());
    }
}
