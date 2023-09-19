<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventLinkMutations\MutationResolvers;

use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use EM_Category;
use EM_Event;
use PoPSitesWassup\CustomPostLinkMutations\MutationResolvers\MutationResolverUtils;
use PoPSitesWassup\EventMutations\MutationResolvers\AbstractCreateUpdateEventMutationResolver;

abstract class AbstractCreateUpdateEventLinkMutationResolver extends AbstractCreateUpdateEventMutationResolver
{
    /**
     * @param array<string,mixed> $customPostData
     */
    protected function populate(object &$event, array $customPostData): void
    {
        /** @var EM_Event */
        $EM_Event = &$event;
        // Add class "Link" on the event object
        if (!$EM_Event->get_categories()->terms[\POP_EVENTLINKS_CAT_EVENTLINKS]) {
            $EM_Event->get_categories()->terms[\POP_EVENTLINKS_CAT_EVENTLINKS] = new EM_Category(\POP_EVENTLINKS_CAT_EVENTLINKS);
        }
        parent::populate($EM_Event, $customPostData);
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
