<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostLinkMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\LocationPostLinkMutations\MutationResolvers\CreateLocationPostLinkMutationResolver;
use PoPSitesWassup\LocationPostMutations\MutationResolverBridges\AbstractCreateUpdateLocationPostMutationResolverBridge;

class CreateLocationPostLinkMutationResolverBridge extends AbstractCreateUpdateLocationPostMutationResolverBridge
{
    private ?CreateLocationPostLinkMutationResolver $createLocationPostLinkMutationResolver = null;

    final protected function getCreateLocationPostLinkMutationResolver(): CreateLocationPostLinkMutationResolver
    {
        if ($this->createLocationPostLinkMutationResolver === null) {
            /** @var CreateLocationPostLinkMutationResolver */
            $createLocationPostLinkMutationResolver = $this->instanceManager->getInstance(CreateLocationPostLinkMutationResolver::class);
            $this->createLocationPostLinkMutationResolver = $createLocationPostLinkMutationResolver;
        }
        return $this->createLocationPostLinkMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getCreateLocationPostLinkMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return false;
    }
}
