<?php

declare(strict_types=1);

namespace LegacyPoP\LooseContracts;

abstract class AbstractLooseContractSet extends \PoP\LooseContracts\AbstractLooseContractSet
{
    public function initialize(): void
    {
        parent::initialize();

        /** @var LooseContractManagerInterface */
        $looseContractManager = $this->getLooseContractManager();
        $looseContractManager->requireHooks(
            $this->getRequiredHooks()
        );
    }

    /**
     * @return string[]
     */
    public function getRequiredHooks(): array
    {
        return [];
    }
}
