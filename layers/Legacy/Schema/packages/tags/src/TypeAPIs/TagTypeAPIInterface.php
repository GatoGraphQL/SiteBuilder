<?php

declare(strict_types=1);

namespace EverythingElse\PoPCMSSchema\Tags\TypeAPIs;

use PoPCMSSchema\Tags\TypeAPIs\TagTaxonomyTypeAPIInterface as UpstreamTagTypeAPIInterface;

interface TagTaxonomyTypeAPIInterface extends UpstreamTagTypeAPIInterface
{
    public function getTagBase(): string;
}
