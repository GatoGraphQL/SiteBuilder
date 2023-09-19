<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\LocationPostMutations\MutationResolvers\UpdateLocationPostMutationResolver;

class UpdateLocationPostMutationResolverBridge extends AbstractCreateUpdateLocationPostMutationResolverBridge
{
    private ?UpdateLocationPostMutationResolver $updateLocationPostMutationResolver = null;

    final public function setUpdateLocationPostMutationResolver(UpdateLocationPostMutationResolver $updateLocationPostMutationResolver): void
    {
        $this->updateLocationPostMutationResolver = $updateLocationPostMutationResolver;
    }
    final protected function getUpdateLocationPostMutationResolver(): UpdateLocationPostMutationResolver
    {
        if ($this->updateLocationPostMutationResolver === null) {
            /** @var UpdateLocationPostMutationResolver */
            $updateLocationPostMutationResolver = $this->instanceManager->getInstance(UpdateLocationPostMutationResolver::class);
            $this->updateLocationPostMutationResolver = $updateLocationPostMutationResolver;
        }
        return $this->updateLocationPostMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getUpdateLocationPostMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return true;
    }
}
