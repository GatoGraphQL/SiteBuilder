<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts;

class Environment
{
    public final const LOCATIONPOST_LIST_DEFAULT_LIMIT = 'LOCATIONPOST_LIST_DEFAULT_LIMIT';
    public final const LOCATIONPOST_LIST_MAX_LIMIT = 'LOCATIONPOST_LIST_MAX_LIMIT';

    /**
     * Customize the Location Post type name
     */
    public static function getLocationPostTypeName(): ?string
    {
        return getenv('LOCATION_POST_TYPE_NAME') !== false ? getenv('LOCATION_POST_TYPE_NAME') : null;
    }
}
