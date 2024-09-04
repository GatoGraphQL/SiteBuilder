<?php

declare(strict_types=1);

namespace EverythingElse\PoPCMSSchema\Categories\TypeAPIs;

use PoPCMSSchema\Categories\TypeAPIs\CategoryTaxonomyTypeAPIInterface as UpstreamCategoryTypeAPIInterface;

interface CategoryTaxonomyTypeAPIInterface extends UpstreamCategoryTypeAPIInterface
{
    public function getCategoryBase(): string;
    public function hasCategory($catObjectOrID, $post_id);
    public function getCategoryPath($category_id);
}
