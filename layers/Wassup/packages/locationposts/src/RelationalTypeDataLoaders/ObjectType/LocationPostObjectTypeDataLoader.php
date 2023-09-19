<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\RelationalTypeDataLoaders\ObjectType;

use PoPCMSSchema\LocationPosts\TypeAPIs\LocationPostTypeAPIInterface;
use PoPCMSSchema\Posts\RelationalTypeDataLoaders\ObjectType\PostObjectTypeDataLoader;

class LocationPostObjectTypeDataLoader extends PostObjectTypeDataLoader
{
    private ?LocationPostTypeAPIInterface $locationPostTypeAPI = null;

    final public function setLocationPostTypeAPI(LocationPostTypeAPIInterface $locationPostTypeAPI): void
    {
        $this->locationPostTypeAPI = $locationPostTypeAPI;
    }
    final protected function getLocationPostTypeAPI(): LocationPostTypeAPIInterface
    {
        if ($this->locationPostTypeAPI === null) {
            /** @var LocationPostTypeAPIInterface */
            $locationPostTypeAPI = $this->instanceManager->getInstance(LocationPostTypeAPIInterface::class);
            $this->locationPostTypeAPI = $locationPostTypeAPI;
        }
        return $this->locationPostTypeAPI;
    }

    /**
     * @return mixed[]
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function executeQuery(array $query, array $options = []): array
    {
        return $this->getLocationPostTypeAPI()->getLocationPosts($query, $options);
    }
}
