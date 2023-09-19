<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventLinkMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateCustomPostMutationResolverTrait;

class CreateEventLinkMutationResolver extends AbstractCreateUpdateEventLinkMutationResolver
{
    use CreateCustomPostMutationResolverTrait;
}
