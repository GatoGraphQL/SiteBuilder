<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\ConditionalOnModule\Tags\FieldResolvers\ObjectType;

use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoPCMSSchema\LocationPosts\FieldResolvers\ObjectType\AbstractLocationPostObjectTypeFieldResolver;

/**
 * Fields for event tags
 *
 * @author Leonardo Losoviz <leo@getpop.org>
 * @todo Create LocationTagTypeResolver class, then remove abstract
 */
abstract class LocationPostTagObjectTypeFieldResolver extends AbstractLocationPostObjectTypeFieldResolver
{
    // public function getObjectTypeResolverClassesToAttachTo(): array
    // {
    //     return array(LocationTagTypeResolver::class);
    // }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return match ($fieldName) {
            'locationposts' => $this->__('Location Posts which contain this tag', 'locationposts'),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    /**
     * @return array<string,mixed>
     */
    protected function getQuery(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        FieldDataAccessorInterface $fieldDataAccessor,
    ): array {
        $query = parent::getQuery($objectTypeResolver, $object, $fieldDataAccessor);

        $tag = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'locationposts':
                $query['tag-ids'] = [$objectTypeResolver->getID($tag)];
                break;
        }

        return $query;
    }
}
