<?php

declare(strict_types=1);

namespace PoPSitesWassup\HighlightMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\HighlightMutations\MutationResolvers\CreateHighlightMutationResolver;

class CreateHighlightMutationResolverBridge extends AbstractCreateUpdateHighlightMutationResolverBridge
{
    private ?CreateHighlightMutationResolver $createHighlightMutationResolver = null;

    final protected function getCreateHighlightMutationResolver(): CreateHighlightMutationResolver
    {
        if ($this->createHighlightMutationResolver === null) {
            /** @var CreateHighlightMutationResolver */
            $createHighlightMutationResolver = $this->instanceManager->getInstance(CreateHighlightMutationResolver::class);
            $this->createHighlightMutationResolver = $createHighlightMutationResolver;
        }
        return $this->createHighlightMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getCreateHighlightMutationResolver();
    }

    protected function isUpdate(): bool
    {
        return false;
    }
}
