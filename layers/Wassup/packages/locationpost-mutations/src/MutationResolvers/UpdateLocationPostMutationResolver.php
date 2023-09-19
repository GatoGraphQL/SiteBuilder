<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateCustomPostMutationResolverTrait;

class UpdateLocationPostMutationResolver extends AbstractCreateUpdateLocationPostMutationResolver
{
    use UpdateCustomPostMutationResolverTrait;
}
