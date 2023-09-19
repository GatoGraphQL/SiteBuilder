<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostLinkMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\LocationPostLinkMutations\MutationResolvers\UpdateLocationPostLinkMutationResolver;
use PoPSitesWassup\LocationPostMutations\MutationResolverBridges\AbstractCreateUpdateLocationPostMutationResolverBridge;

class UpdateLocationPostLinkMutationResolverBridge extends AbstractCreateUpdateLocationPostMutationResolverBridge
{
    private ?UpdateLocationPostLinkMutationResolver $updateLocationPostLinkMutationResolver = null;

    final public function setUpdateLocationPostLinkMutationResolver(UpdateLocationPostLinkMutationResolver $updateLocationPostLinkMutationResolver): void
    {
        $this->updateLocationPostLinkMutationResolver = $updateLocationPostLinkMutationResolver;
    }
    final protected function getUpdateLocationPostLinkMutationResolver(): UpdateLocationPostLinkMutationResolver
    {
        if ($this->updateLocationPostLinkMutationResolver === null) {
            /** @var UpdateLocationPostLinkMutationResolver */
            $updateLocationPostLinkMutationResolver = $this->instanceManager->getInstance(UpdateLocationPostLinkMutationResolver::class);
            $this->updateLocationPostLinkMutationResolver = $updateLocationPostLinkMutationResolver;
        }
        return $this->updateLocationPostLinkMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getUpdateLocationPostLinkMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return true;
    }
}
