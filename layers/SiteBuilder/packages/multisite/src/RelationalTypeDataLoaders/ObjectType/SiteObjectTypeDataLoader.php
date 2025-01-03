<?php

declare(strict_types=1);

namespace PoP\Multisite\RelationalTypeDataLoaders\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeDataLoader;
use PoP\Engine\FunctionAPIFactory;
use PoP\Multisite\ObjectModels\Site;

class SiteObjectTypeDataLoader extends AbstractObjectTypeDataLoader
{
    private ?Site $site = null;

    final protected function getSite(): Site
    {
        if ($this->site === null) {
            /** @var Site */
            $site = $this->instanceManager->getInstance(Site::class);
            $this->site = $site;
        }
        return $this->site;
    }

    /**
     * @param array<string|int> $ids
     * @return array<object|null>
     */
    public function getObjects(array $ids): array
    {
        // Currently it deals only with the current site and nothing else
        $ret = [];
        $cmsengineapi = FunctionAPIFactory::getInstance();
        if (in_array($cmsengineapi->getHost(), $ids)) {
            $ret[] = $this->getSite();
        }
        return $ret;
    }
}
