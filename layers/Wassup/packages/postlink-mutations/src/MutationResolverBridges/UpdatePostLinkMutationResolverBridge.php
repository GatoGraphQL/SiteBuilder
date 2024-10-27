<?php

declare(strict_types=1);

namespace PoPSitesWassup\PostLinkMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\PostLinkMutations\MutationResolvers\UpdatePostLinkMutationResolver;

class UpdatePostLinkMutationResolverBridge extends AbstractCreateUpdatePostLinkMutationResolverBridge
{
    private ?UpdatePostLinkMutationResolver $updatePostLinkMutationResolver = null;

    final protected function getUpdatePostLinkMutationResolver(): UpdatePostLinkMutationResolver
    {
        if ($this->updatePostLinkMutationResolver === null) {
            /** @var UpdatePostLinkMutationResolver */
            $updatePostLinkMutationResolver = $this->instanceManager->getInstance(UpdatePostLinkMutationResolver::class);
            $this->updatePostLinkMutationResolver = $updatePostLinkMutationResolver;
        }
        return $this->updatePostLinkMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getUpdatePostLinkMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return true;
    }
}
