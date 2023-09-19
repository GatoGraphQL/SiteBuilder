<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolverBridges\AbstractComponentMutationResolverBridge;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\LocationMutations\MutationResolvers\CreateLocationMutationResolver;

class CreateLocationMutationResolverBridge extends AbstractComponentMutationResolverBridge
{
    private ?CreateLocationMutationResolver $createLocationMutationResolver = null;

    final public function setCreateLocationMutationResolver(CreateLocationMutationResolver $createLocationMutationResolver): void
    {
        $this->createLocationMutationResolver = $createLocationMutationResolver;
    }
    final protected function getCreateLocationMutationResolver(): CreateLocationMutationResolver
    {
        if ($this->createLocationMutationResolver === null) {
            /** @var CreateLocationMutationResolver */
            $createLocationMutationResolver = $this->instanceManager->getInstance(CreateLocationMutationResolver::class);
            $this->createLocationMutationResolver = $createLocationMutationResolver;
        }
        return $this->createLocationMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getCreateLocationMutationResolver();
    }

    /**
     * @param array<string,mixed> $mutationData
     */
    public function addMutationDataForFieldDataAccessor(array &$mutationData): void
    {
    }
}
