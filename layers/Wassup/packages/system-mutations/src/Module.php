<?php

declare(strict_types=1);

namespace PoPSitesWassup\SystemMutations;

use PoP\Root\Module\ModuleInterface;
use PoP\Root\Module\AbstractModule;

class Module extends AbstractModule
{
    /**
     * @return array<class-string<ModuleInterface>>
     */
    public function getDependedModuleClasses(): array
    {
        return [
            \PoP\Engine\Module::class,
        ];
    }

    /**
     * Initialize services
     *
     * @param array<class-string<ModuleInterface>> $skipSchemaModuleClasses
     */
    protected function initializeContainerServices(
        bool $skipSchema,
        array $skipSchemaModuleClasses,
    ): void {
        $this->initSchemaServices(dirname(__DIR__), $skipSchema);
    }
}
