<?php

declare(strict_types=1);

namespace EverythingElse\PoPCMSSchema\TagsWP\TypeAPIs;

use PoPCMSSchema\SchemaCommons\Facades\CMS\CMSServiceFacade;
use PoPCMSSchema\TagsWP\TypeAPIs\AbstractTagTaxonomyTypeAPI as UpstreamAbstractTagTypeAPI;
use PoPCMSSchema\Tags\TypeAPIs\TagTaxonomyTypeAPIInterface;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
abstract class AbstractTagTaxonomyTypeAPI extends UpstreamAbstractTagTypeAPI implements TagTaxonomyTypeAPIInterface
{
    public function getTagBase(): string
    {
        $cmsService = CMSServiceFacade::getInstance();
        return (string)$cmsService->getOption($this->getTagBaseOption());
    }

    abstract protected function getTagBaseOption(): string;
}
