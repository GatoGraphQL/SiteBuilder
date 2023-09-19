<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\Facades;

use PoP\Root\App;
use PoPCMSSchema\LocationPosts\TypeAPIs\LocationPostTypeAPIInterface;

class LocationPostTypeAPIFacade
{
    public static function getInstance(): LocationPostTypeAPIInterface
    {
        /**
         * @var LocationPostTypeAPIInterface
         */
        $service = App::getContainer()->get(LocationPostTypeAPIInterface::class);
        return $service;
    }
}
