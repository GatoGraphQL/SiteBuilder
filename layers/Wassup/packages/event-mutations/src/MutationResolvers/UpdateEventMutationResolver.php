<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateCustomPostMutationResolverTrait;

class UpdateEventMutationResolver extends AbstractCreateUpdateEventMutationResolver
{
    use UpdateCustomPostMutationResolverTrait;
}
