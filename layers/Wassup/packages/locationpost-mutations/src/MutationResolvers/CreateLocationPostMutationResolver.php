<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateCustomPostMutationResolverTrait;

class CreateLocationPostMutationResolver extends AbstractCreateUpdateLocationPostMutationResolver
{
    use CreateCustomPostMutationResolverTrait;
}
