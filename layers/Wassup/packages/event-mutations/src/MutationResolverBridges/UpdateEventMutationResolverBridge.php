<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\EventMutations\MutationResolvers\UpdateEventMutationResolver;

class UpdateEventMutationResolverBridge extends AbstractCreateUpdateEventMutationResolverBridge
{
    private ?UpdateEventMutationResolver $updateEventMutationResolver = null;

    final protected function getUpdateEventMutationResolver(): UpdateEventMutationResolver
    {
        if ($this->updateEventMutationResolver === null) {
            /** @var UpdateEventMutationResolver */
            $updateEventMutationResolver = $this->instanceManager->getInstance(UpdateEventMutationResolver::class);
            $this->updateEventMutationResolver = $updateEventMutationResolver;
        }
        return $this->updateEventMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getUpdateEventMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return true;
    }
}
