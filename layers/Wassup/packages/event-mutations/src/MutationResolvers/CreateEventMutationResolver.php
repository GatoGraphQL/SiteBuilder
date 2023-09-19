<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateCustomPostMutationResolverTrait;

class CreateEventMutationResolver extends AbstractCreateUpdateEventMutationResolver
{
    use CreateCustomPostMutationResolverTrait;
}
