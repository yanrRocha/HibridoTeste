<?php
/**
 * Copyright © author: Yan Rodrigues Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Hibrido\ChangeButtonColor\Console\Command;

use Hibrido\ChangeButtonColor\Service\ChangeButtonColorConfiguration;
use Magento\Framework\App\Cache\Manager;
use Magento\Store\Model\StoreManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ColorChange extends Command
{

    private const COLOR_ARGUMENT = "color";
    private const STORE_ARGUMENT = "store";

    /**
     * @var ChangeButtonColorConfiguration
     */
    private ChangeButtonColorConfiguration $changeButtonColorConfiguration;

    /**
     * @var StoreManager
     */
    private StoreManager $storeManager;

    /**
     * @var Manager
     */
    private Manager $cacheManager;

    /**
     * @param ChangeButtonColorConfiguration $changeButtonColorConfiguration
     * @param StoreManager $storeManager
     * @param Manager $cacheManager
     */
    public function __construct(
        ChangeButtonColorConfiguration $changeButtonColorConfiguration,
        StoreManager $storeManager,
        Manager $cacheManager
    ) {
        $this->changeButtonColorConfiguration = $changeButtonColorConfiguration;
        $this->storeManager = $storeManager;
        $this->cacheManager = $cacheManager;

        parent::__construct("color:change");
    }

    /**
     * @inheritdoc
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $color = $input->getArgument(self::COLOR_ARGUMENT);
        $store = $input->getArgument(self::STORE_ARGUMENT);
        $output->writeln("Hello " . $color . ' ----- ' . $store);

        if (!preg_match('/^[a-f0-9]{6}$/i', $color)) {
            $output->writeln('The color ' . $color . ' is not valid.');
            return Command::FAILURE;
        }

        try {
            $store = $this->storeManager->getStore($store);
            $this->changeButtonColorConfiguration->setColor($color, $store->getId());
            $this->changeButtonColorConfiguration->setIsEnabled(1, $store->getId());
            $this->cacheManager->clean($this->cacheManager->getAvailableTypes());

        } catch (\Exception $e) {
            $output->writeln('The store with id ' . $store . ' is not valid.');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    /**
     * @inheritdoc
     */
    protected function configure(): void
    {
        $this->setName("color:change");
        $this->setDescription("change buttons color");
        $this->setDefinition([
            new InputArgument(self::COLOR_ARGUMENT, InputArgument::REQUIRED, "Color"),
            new InputArgument(self::STORE_ARGUMENT, InputArgument::REQUIRED, "Store")
        ]);
        parent::configure();
    }
}
