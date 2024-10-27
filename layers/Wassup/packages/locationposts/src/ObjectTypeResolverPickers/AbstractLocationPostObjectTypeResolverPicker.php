<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\ObjectTypeResolverPickers;

use PoP\ComponentModel\ObjectTypeResolverPickers\AbstractObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPCMSSchema\LocationPosts\TypeAPIs\LocationPostTypeAPIInterface;
use PoPCMSSchema\LocationPosts\TypeResolvers\ObjectType\LocationPostObjectTypeResolver;

abstract class AbstractLocationPostObjectTypeResolverPicker extends AbstractObjectTypeResolverPicker
{
    private ?LocationPostObjectTypeResolver $locationPostObjectTypeResolver = null;
    private ?LocationPostTypeAPIInterface $locationPostTypeAPI = null;

    final protected function getLocationPostObjectTypeResolver(): LocationPostObjectTypeResolver
    {
        if ($this->locationPostObjectTypeResolver === null) {
            /** @var LocationPostObjectTypeResolver */
            $locationPostObjectTypeResolver = $this->instanceManager->getInstance(LocationPostObjectTypeResolver::class);
            $this->locationPostObjectTypeResolver = $locationPostObjectTypeResolver;
        }
        return $this->locationPostObjectTypeResolver;
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

    public function getObjectTypeResolver(): ObjectTypeResolverInterface
    {
        return $this->getLocationPostObjectTypeResolver();
    }

    public function isInstanceOfType(object $object): bool
    {
        return $this->getLocationPostTypeAPI()->isInstanceOfLocationPostType($object);
    }

    public function isIDOfType(string|int $objectID): bool
    {
        return $this->getLocationPostTypeAPI()->locationPostExists($objectID);
    }
}
