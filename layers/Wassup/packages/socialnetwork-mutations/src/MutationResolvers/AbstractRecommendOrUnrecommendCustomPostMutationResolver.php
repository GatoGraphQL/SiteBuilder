<?php

declare(strict_types=1);

namespace PoPSitesWassup\SocialNetworkMutations\MutationResolvers;

use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\App;
use PoP\Application\PostsFunctionAPIFactory;

abstract class AbstractRecommendOrUnrecommendCustomPostMutationResolver extends AbstractCustomPostUpdateUserMetaValueMutationResolver
{
    protected function eligible($post)
    {
        $cmsapplicationpostsapi = PostsFunctionAPIFactory::getInstance();
        $eligible = in_array($this->getCustomPostTypeAPI()->getCustomPostType($post), $cmsapplicationpostsapi->getAllcontentPostTypes());
        return App::applyFilters('GD_RecommendUnrecommendPost:eligible', $eligible, $post);
    }

    /**
     * Function to override
     */
    protected function additionals($target_id, FieldDataAccessorInterface $fieldDataAccessor): void
    {
        parent::additionals($target_id, $fieldDataAccessor);
        App::doAction('gd_recommendunrecommend_post', $target_id, $fieldDataAccessor);
    }
}
