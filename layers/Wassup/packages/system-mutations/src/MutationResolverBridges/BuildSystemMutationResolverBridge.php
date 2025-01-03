<?php

declare(strict_types=1);

namespace PoPSitesWassup\SystemMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\SystemMutations\MutationResolvers\BuildSystemMutationResolver;

class BuildSystemMutationResolverBridge extends AbstractSystemComponentMutationResolverBridge
{
    private ?BuildSystemMutationResolver $buildSystemMutationResolver = null;

    final protected function getBuildSystemMutationResolver(): BuildSystemMutationResolver
    {
        if ($this->buildSystemMutationResolver === null) {
            /** @var BuildSystemMutationResolver */
            $buildSystemMutationResolver = $this->instanceManager->getInstance(BuildSystemMutationResolver::class);
            $this->buildSystemMutationResolver = $buildSystemMutationResolver;
        }
        return $this->buildSystemMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getBuildSystemMutationResolver();
    }
    public function getSuccessString(string|int $result_id): ?string
    {
        return $this->__('System action "build" executed successfully.', 'pop-system');
        ;
    }
}
