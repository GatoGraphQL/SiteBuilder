<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventLinkMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\EventLinkMutations\MutationResolvers\CreateEventLinkMutationResolver;

class CreateEventLinkMutationResolverBridge extends AbstractCreateUpdateEventLinkMutationResolverBridge
{
    private ?CreateEventLinkMutationResolver $createEventLinkMutationResolver = null;

    final public function setCreateEventLinkMutationResolver(CreateEventLinkMutationResolver $createEventLinkMutationResolver): void
    {
        $this->createEventLinkMutationResolver = $createEventLinkMutationResolver;
    }
    final protected function getCreateEventLinkMutationResolver(): CreateEventLinkMutationResolver
    {
        if ($this->createEventLinkMutationResolver === null) {
            /** @var CreateEventLinkMutationResolver */
            $createEventLinkMutationResolver = $this->instanceManager->getInstance(CreateEventLinkMutationResolver::class);
            $this->createEventLinkMutationResolver = $createEventLinkMutationResolver;
        }
        return $this->createEventLinkMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getCreateEventLinkMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return false;
    }
}
