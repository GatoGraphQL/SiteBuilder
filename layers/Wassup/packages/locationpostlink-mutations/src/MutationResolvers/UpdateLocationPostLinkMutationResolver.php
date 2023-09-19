<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostLinkMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateCustomPostMutationResolverTrait;

class UpdateLocationPostLinkMutationResolver extends AbstractCreateUpdateLocationPostLinkMutationResolver
{
    use UpdateCustomPostMutationResolverTrait;
}
