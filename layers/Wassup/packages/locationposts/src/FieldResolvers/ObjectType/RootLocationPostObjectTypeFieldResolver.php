<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\FieldResolvers\ObjectType;

use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;

class RootLocationPostObjectTypeFieldResolver extends AbstractLocationPostObjectTypeFieldResolver
{
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            RootObjectTypeResolver::class,
        ];
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return match ($fieldName) {
            'posts' => $this->__('Location Posts in the current site', 'locationposts'),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }
}
