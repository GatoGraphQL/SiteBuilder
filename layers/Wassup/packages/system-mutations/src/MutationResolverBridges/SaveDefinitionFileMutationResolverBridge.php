<?php

declare(strict_types=1);

namespace PoPSitesWassup\SystemMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\SystemMutations\MutationResolvers\SaveDefinitionFileMutationResolver;

class SaveDefinitionFileMutationResolverBridge extends AbstractSystemComponentMutationResolverBridge
{
    private ?SaveDefinitionFileMutationResolver $saveDefinitionFileMutationResolver = null;

    final protected function getSaveDefinitionFileMutationResolver(): SaveDefinitionFileMutationResolver
    {
        if ($this->saveDefinitionFileMutationResolver === null) {
            /** @var SaveDefinitionFileMutationResolver */
            $saveDefinitionFileMutationResolver = $this->instanceManager->getInstance(SaveDefinitionFileMutationResolver::class);
            $this->saveDefinitionFileMutationResolver = $saveDefinitionFileMutationResolver;
        }
        return $this->saveDefinitionFileMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getSaveDefinitionFileMutationResolver();
    }

    public function getSuccessString(string|int $result_id): ?string
    {
        return $this->__('System action "save definition file" executed successfully.', 'pop-system');
    }
}
