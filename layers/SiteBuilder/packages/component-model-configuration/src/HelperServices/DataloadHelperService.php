<?php

declare(strict_types=1);

namespace PoP\ConfigurationComponentModel\HelperServices;

use PoP\ComponentModel\Misc\GeneralUtils;
use PoP\ComponentModel\ComponentProcessors\FilterInputComponentProcessorInterface;
use PoP\ComponentModel\ComponentProcessors\ComponentProcessorManagerInterface;
use PoP\Root\Services\AbstractBasicService;

class DataloadHelperService extends AbstractBasicService implements DataloadHelperServiceInterface
{
    private ?ComponentProcessorManagerInterface $componentProcessorManager = null;

    final protected function getComponentProcessorManager(): ComponentProcessorManagerInterface
    {
        if ($this->componentProcessorManager === null) {
            /** @var ComponentProcessorManagerInterface */
            $componentProcessorManager = $this->instanceManager->getInstance(ComponentProcessorManagerInterface::class);
            $this->componentProcessorManager = $componentProcessorManager;
        }
        return $this->componentProcessorManager;
    }

    /**
     * @param array<array<string,mixed>> $componentValues
     */
    public function addFilterParams(string $url, array $componentValues = []): string
    {
        $componentProcessorManager = $this->getComponentProcessorManager();
        $args = [];
        foreach ($componentValues as $componentValue) {
            $component = $componentValue['component'];
            $value = $componentValue['value'];
            /** @var FilterInputComponentProcessorInterface */
            $componentProcessor = $componentProcessorManager->getComponentProcessor($component);
            $args[$componentProcessor->getName($component)] = $value;
        }
        return GeneralUtils::addQueryArgs($args, $url);
    }
}
