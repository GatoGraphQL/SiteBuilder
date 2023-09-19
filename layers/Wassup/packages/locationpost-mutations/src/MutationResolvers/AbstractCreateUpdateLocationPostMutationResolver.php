<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostMutations\MutationResolvers;

use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoPCMSSchema\CustomPostMeta\Utils;
use PoPSitesWassup\CustomPostMutations\MutationResolvers\AbstractCreateOrUpdateCustomPostMutationResolver;

abstract class AbstractCreateUpdateLocationPostMutationResolver extends AbstractCreateOrUpdateCustomPostMutationResolver
{
    public function getCustomPostType(): string
    {
        return \POP_LOCATIONPOSTS_POSTTYPE_LOCATIONPOST;
    }

    protected function additionals(string|int $post_id, FieldDataAccessorInterface $fieldDataAccessor): void
    {
        parent::additionals($post_id, $fieldDataAccessor);

        // Locations
        Utils::updateCustomPostMeta($post_id, \GD_METAKEY_POST_LOCATIONS, $fieldDataAccessor->getValue('locations'));
    }
}
