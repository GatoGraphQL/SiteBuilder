<?php

declare(strict_types=1);

namespace PoPSitesWassup\SocialNetworkMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoPSitesWassup\SocialNetworkMutations\MutationResolvers\FollowUserMutationResolver;

class FollowUserMutationResolverBridge extends AbstractUserUpdateUserMetaValueMutationResolverBridge
{
    private ?FollowUserMutationResolver $followUserMutationResolver = null;

    final protected function getFollowUserMutationResolver(): FollowUserMutationResolver
    {
        if ($this->followUserMutationResolver === null) {
            /** @var FollowUserMutationResolver */
            $followUserMutationResolver = $this->instanceManager->getInstance(FollowUserMutationResolver::class);
            $this->followUserMutationResolver = $followUserMutationResolver;
        }
        return $this->followUserMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getFollowUserMutationResolver();
    }

    protected function onlyExecuteWhenDoingPost(): bool
    {
        return false;
    }

    public function getSuccessString(string|int $result_id): ?string
    {
        return sprintf(
            $this->__('You are now following <em><strong>%s</strong></em>.', 'pop-coreprocessors'),
            $this->getUserTypeAPI()->getUserDisplayName($result_id)
        );
    }
}
