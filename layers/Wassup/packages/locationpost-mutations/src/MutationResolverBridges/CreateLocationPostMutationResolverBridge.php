<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\LocationPostMutations\MutationResolvers\CreateLocationPostMutationResolver;

class CreateLocationPostMutationResolverBridge extends AbstractCreateUpdateLocationPostMutationResolverBridge
{
    private ?CreateLocationPostMutationResolver $createLocationPostMutationResolver = null;

    final protected function getCreateLocationPostMutationResolver(): CreateLocationPostMutationResolver
    {
        if ($this->createLocationPostMutationResolver === null) {
            /** @var CreateLocationPostMutationResolver */
            $createLocationPostMutationResolver = $this->instanceManager->getInstance(CreateLocationPostMutationResolver::class);
            $this->createLocationPostMutationResolver = $createLocationPostMutationResolver;
        }
        return $this->createLocationPostMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getCreateLocationPostMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return false;
    }
}
