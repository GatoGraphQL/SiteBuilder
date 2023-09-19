<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\FieldResolvers\ObjectType;

use PoPCMSSchema\LocationPosts\TypeResolvers\ObjectType\LocationPostObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\LeafField;

class LocationPostObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    private ?StringScalarTypeResolver $stringScalarTypeResolver = null;

    final public function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver): void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    final protected function getStringScalarTypeResolver(): StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }

    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo(): array
    {
        return [
            LocationPostObjectTypeResolver::class,
        ];
    }

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'categories',
            'catSlugs',
            'catName',
        ];
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        return match ($fieldName) {
            'catSlugs',
            'catName'
                => $this->getStringScalarTypeResolver(),
            default
                => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        return match ($fieldName) {
            'categories',
            'catSlugs'
                => SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY,
            default
                => parent::getFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return match ($fieldName) {
            'categories' => $this->__('', ''),
            'catSlugs' => $this->__('', ''),
            'catName' => $this->__('', ''),
            default => parent::getFieldDescription($objectTypeResolver, $fieldName),
        };
    }

    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        $locationpost = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'categories':
                /**
                 * @todo TaxonomyTypeAPI was removed! This stale code must be fixed
                 */
                return $this->getTaxonomyTypeAPI()->getCustomPostTaxonomyTerms(
                    $objectTypeResolver->getID($locationpost),
                    [
                        'taxonomy' => POP_LOCATIONPOSTS_TAXONOMY_CATEGORY,
                    ],
                    [
                        QueryOptions::RETURN_TYPE => ReturnTypes::IDS,
                    ]
                ) ?? [];

            case 'catSlugs':
                /**
                 * @todo TaxonomyTypeAPI was removed! This stale code must be fixed
                 */
                return $this->getTaxonomyTypeAPI()->getCustomPostTaxonomyTerms(
                    $objectTypeResolver->getID($locationpost),
                    [
                        'taxonomy' => POP_LOCATIONPOSTS_TAXONOMY_CATEGORY,
                    ],
                    [
                        QueryOptions::RETURN_TYPE => ReturnTypes::SLUGS,
                    ]
                ) ?? [];

            case 'catName':
                $cat = $objectTypeResolver->resolveValue(
                    $object,
                    new LeafField(
                        'mainCategory',
                        null,
                        [],
                        [],
                        $fieldDataAccessor->getField()->getLocation()
                    ),
                    $objectTypeFieldResolutionFeedbackStore,
                );
                if ($objectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
                    return $cat;
                } elseif ($cat) {
                    /**
                     * @todo TaxonomyTypeAPI was removed! This stale code must be fixed
                     */
                    return $this->getTaxonomyTypeAPI()->getTermName($cat, POP_LOCATIONPOSTS_TAXONOMY_CATEGORY);
                }
                return null;
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
}
