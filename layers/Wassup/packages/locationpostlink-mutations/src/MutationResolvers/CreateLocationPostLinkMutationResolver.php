<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostLinkMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateCustomPostMutationResolverTrait;

class CreateLocationPostLinkMutationResolver extends AbstractCreateUpdateLocationPostLinkMutationResolver
{
    use CreateCustomPostMutationResolverTrait;
}
