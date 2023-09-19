<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostLinkMutations\MutationResolvers;

use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoPSitesWassup\CustomPostLinkMutations\MutationResolvers\MutationResolverUtils;
use PoPSitesWassup\LocationPostMutations\MutationResolvers\AbstractCreateUpdateLocationPostMutationResolver;

abstract class AbstractCreateUpdateLocationPostLinkMutationResolver extends AbstractCreateUpdateLocationPostMutationResolver
{
    protected function getCategories(FieldDataAccessorInterface $fieldDataAccessor): ?array
    {
        $ret = parent::getCategories($fieldDataAccessor);
        if (defined('POP_LOCATIONPOSTLINKS_CAT_LOCATIONPOSTLINKS') && POP_LOCATIONPOSTLINKS_CAT_LOCATIONPOSTLINKS) {
            $ret[] = POP_LOCATIONPOSTLINKS_CAT_LOCATIONPOSTLINKS;
        }
        return $ret;
    }

    /**
     * Function below was copied from class GD_CreateUpdate_PostLink
     * @param string[] $errors
     * @todo Must migrate logic to `validateCreateUpdateErrors`
     */
    protected function validateContent(array &$errors, FieldDataAccessorInterface $fieldDataAccessor): void
    {
        parent::validateContent($errors, $fieldDataAccessor);
        MutationResolverUtils::validateContent($errors, $fieldDataAccessor);
    }
}
