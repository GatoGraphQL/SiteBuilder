<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\FieldResolvers\ObjectType;

use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractQueryableObjectTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Root\App;
use PoPCMSSchema\LocationPosts\Module;
use PoPCMSSchema\LocationPosts\ModuleConfiguration;
use PoPCMSSchema\LocationPosts\TypeAPIs\LocationPostTypeAPIInterface;
use PoPCMSSchema\LocationPosts\TypeResolvers\ObjectType\LocationPostObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPSchema\SchemaCommons\Constants\QueryOptions;

abstract class AbstractLocationPostObjectTypeFieldResolver extends AbstractQueryableObjectTypeFieldResolver
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

    /**
     * @return string[]
     */
    public function getFieldNamesToResolve(): array
    {
        return [
            'locationposts',
        ];
    }

    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): int
    {
        return match ($fieldName) {
            'locationposts' => SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY,
            default => parent::getFieldTypeModifiers($objectTypeResolver, $fieldName),
        };
    }

    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ?string
    {
        return match ($fieldName) {
            'locationposts' => $this->__('Location Posts', 'locationposts'),
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
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return match ($fieldDataAccessor->getFieldName()) {
            'locationposts' => [
                'limit' => $moduleConfiguration->getLocationPostListDefaultLimit(),
            ],
            default => [],
        };
    }

    public function resolveValue(
        ObjectTypeResolverInterface $objectTypeResolver,
        object $object,
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        switch ($fieldDataAccessor->getFieldName()) {
            case 'locationposts':
                $query = array_merge(
                    $this->convertFieldArgsToFilteringQueryArgs($objectTypeResolver, $fieldDataAccessor),
                    $this->getQuery($objectTypeResolver, $object, $fieldDataAccessor)
                );
                return $this->getLocationPostTypeAPI()->getLocationPosts($query, [QueryOptions::RETURN_TYPE => ReturnTypes::IDS]);
        }

        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }

    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName): ConcreteTypeResolverInterface
    {
        return match ($fieldName) {
            'locationposts' => $this->getLocationPostObjectTypeResolver(),
            default => parent::getFieldTypeResolver($objectTypeResolver, $fieldName),
        };
    }
}
