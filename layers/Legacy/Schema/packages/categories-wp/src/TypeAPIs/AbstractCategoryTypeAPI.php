<?php

declare(strict_types=1);

namespace EverythingElse\PoPCMSSchema\CategoriesWP\TypeAPIs;

use EverythingElse\PoPCMSSchema\Categories\TypeAPIs\CategoryTaxonomyTypeAPIInterface;
use PoPCMSSchema\CategoriesWP\TypeAPIs\AbstractCategoryTaxonomyTypeAPI as UpstreamAbstractCategoryTypeAPI;
use PoPCMSSchema\SchemaCommons\CMS\CMSServiceInterface;

use function wp_set_post_terms;

abstract class AbstractCategoryTaxonomyTypeAPI extends UpstreamAbstractCategoryTypeAPI implements CategoryTaxonomyTypeAPIInterface
{
    private ?CMSServiceInterface $cmsService = null;

    final protected function getCMSService(): CMSServiceInterface
    {
        if ($this->cmsService === null) {
            /** @var CMSServiceInterface */
            $cmsService = $this->instanceManager->getInstance(CMSServiceInterface::class);
            $this->cmsService = $cmsService;
        }
        return $this->cmsService;
    }

    public function hasCategory($cat_id, $post_id): bool
    {
        return has_category($cat_id, $post_id);
    }

    public function getCategoryPath($category_id): string
    {
        $taxonomy = 'category';

        // Convert it to int, otherwise it thinks it's a string and the method below fails
        $category_path = get_term_link((int) $category_id, $taxonomy);

        // Remove the initial part ("https://www.mesym.com/en/categories/")
        global $wp_rewrite;
        $termlink = $wp_rewrite->get_extra_permastruct($taxonomy);
        $termlink = str_replace("%$taxonomy%", '', $termlink);
        $termlink = home_url(user_trailingslashit($termlink, $taxonomy));

        return substr($category_path, strlen($termlink));
    }

    abstract protected function getCategoryBaseOption(): string;

    public function getCategoryBase(): string
    {
        return $this->getCMSService()->getOption($this->getCategoryBaseOption());
    }
}
