<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\EventMutations\MutationResolvers\CreateEventMutationResolver;

class CreateEventMutationResolverBridge extends AbstractCreateUpdateEventMutationResolverBridge
{
    private ?CreateEventMutationResolver $createEventMutationResolver = null;

    final protected function getCreateEventMutationResolver(): CreateEventMutationResolver
    {
        if ($this->createEventMutationResolver === null) {
            /** @var CreateEventMutationResolver */
            $createEventMutationResolver = $this->instanceManager->getInstance(CreateEventMutationResolver::class);
            $this->createEventMutationResolver = $createEventMutationResolver;
        }
        return $this->createEventMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getCreateEventMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return false;
    }
}
