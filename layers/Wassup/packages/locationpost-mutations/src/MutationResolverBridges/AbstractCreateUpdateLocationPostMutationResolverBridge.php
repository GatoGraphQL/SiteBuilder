<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostMutations\MutationResolverBridges;

use PoP_Module_Processor_SelectableTypeaheadMapFormComponents;
use PoPSitesWassup\CustomPostMutations\MutationResolverBridges\AbstractCreateOrUpdateCustomPostMutationResolverBridge;

abstract class AbstractCreateUpdateLocationPostMutationResolverBridge extends AbstractCreateOrUpdateCustomPostMutationResolverBridge
{
    /**
     * @param array<string,mixed> $mutationData
     */
    public function addMutationDataForFieldDataAccessor(array &$mutationData): void
    {
        parent::addMutationDataForFieldDataAccessor($mutationData);

        $locations = $this->getComponentProcessorManager()->getComponentProcessor([PoP_Module_Processor_SelectableTypeaheadMapFormComponents::class, PoP_Module_Processor_SelectableTypeaheadMapFormComponents::COMPONENT_EM_FORMCOMPONENT_TYPEAHEADMAP])->getValue([PoP_Module_Processor_SelectableTypeaheadMapFormComponents::class, PoP_Module_Processor_SelectableTypeaheadMapFormComponents::COMPONENT_EM_FORMCOMPONENT_TYPEAHEADMAP]);
        $mutationData['locations'] = $locations ?? array();
    }

    protected function volunteer(): bool
    {
        return true;
    }
}
