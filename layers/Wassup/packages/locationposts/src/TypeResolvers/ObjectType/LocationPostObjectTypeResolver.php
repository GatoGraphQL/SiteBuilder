<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\TypeResolvers\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoPCMSSchema\LocationPosts\Environment;
use PoPCMSSchema\LocationPosts\RelationalTypeDataLoaders\ObjectType\LocationPostObjectTypeDataLoader;
use PoPCMSSchema\Posts\TypeResolvers\ObjectType\PostObjectTypeResolver;

class LocationPostObjectTypeResolver extends PostObjectTypeResolver
{
    protected ?string $name = null;

    private ?LocationPostObjectTypeDataLoader $locationPostObjectTypeDataLoader = null;

    final public function setLocationPostObjectTypeDataLoader(LocationPostObjectTypeDataLoader $locationPostObjectTypeDataLoader): void
    {
        $this->locationPostObjectTypeDataLoader = $locationPostObjectTypeDataLoader;
    }
    final protected function getLocationPostObjectTypeDataLoader(): LocationPostObjectTypeDataLoader
    {
        if ($this->locationPostObjectTypeDataLoader === null) {
            /** @var LocationPostObjectTypeDataLoader */
            $locationPostObjectTypeDataLoader = $this->instanceManager->getInstance(LocationPostObjectTypeDataLoader::class);
            $this->locationPostObjectTypeDataLoader = $locationPostObjectTypeDataLoader;
        }
        return $this->locationPostObjectTypeDataLoader;
    }

    public function getTypeName(): string
    {
        if ($this->name === null) {
            $this->name = Environment::getLocationPostTypeName() ?? 'LocationPost';
        }
        return $this->name;
    }

    public function getTypeDescription(): ?string
    {
        return $this->__('A post which has locations', 'locationposts');
    }

    public function getRelationalTypeDataLoader(): RelationalTypeDataLoaderInterface
    {
        return $this->getLocationPostObjectTypeDataLoader();
    }
}
