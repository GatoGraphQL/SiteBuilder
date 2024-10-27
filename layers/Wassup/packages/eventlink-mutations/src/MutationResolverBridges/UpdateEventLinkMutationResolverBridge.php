<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventLinkMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\EventLinkMutations\MutationResolvers\UpdateEventLinkMutationResolver;

class UpdateEventLinkMutationResolverBridge extends AbstractCreateUpdateEventLinkMutationResolverBridge
{
    private ?UpdateEventLinkMutationResolver $updateEventLinkMutationResolver = null;

    final protected function getUpdateEventLinkMutationResolver(): UpdateEventLinkMutationResolver
    {
        if ($this->updateEventLinkMutationResolver === null) {
            /** @var UpdateEventLinkMutationResolver */
            $updateEventLinkMutationResolver = $this->instanceManager->getInstance(UpdateEventLinkMutationResolver::class);
            $this->updateEventLinkMutationResolver = $updateEventLinkMutationResolver;
        }
        return $this->updateEventLinkMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getUpdateEventLinkMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return true;
    }
}
