<?php

declare(strict_types=1);

namespace PoPSitesWassup\SocialNetworkMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\SocialNetworkMutations\MutationResolvers\UnfollowUserMutationResolver;

class UnfollowUserMutationResolverBridge extends AbstractUserUpdateUserMetaValueMutationResolverBridge
{
    private ?UnfollowUserMutationResolver $unfollowUserMutationResolver = null;

    final protected function getUnfollowUserMutationResolver(): UnfollowUserMutationResolver
    {
        if ($this->unfollowUserMutationResolver === null) {
            /** @var UnfollowUserMutationResolver */
            $unfollowUserMutationResolver = $this->instanceManager->getInstance(UnfollowUserMutationResolver::class);
            $this->unfollowUserMutationResolver = $unfollowUserMutationResolver;
        }
        return $this->unfollowUserMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getUnfollowUserMutationResolver();
    }

    protected function onlyExecuteWhenDoingPost(): bool
    {
        return false;
    }

    public function getSuccessString(string|int $result_id): ?string
    {
        return sprintf(
            $this->__('You have stopped following <em><strong>%s</strong></em>.', 'pop-coreprocessors'),
            $this->getUserTypeAPI()->getUserDisplayName($result_id)
        );
    }
}
