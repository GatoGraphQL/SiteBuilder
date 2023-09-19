<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventMutations\MutationResolverBridges;

use PoP\ComponentModel\ComponentProcessors\DataloadingConstants;
use PoP_Module_Processor_DateRangeComponentInputs;
use PoP_Module_Processor_SelectableTypeaheadMapFormComponents;
use PoPSitesWassup\CustomPostMutations\MutationResolverBridges\AbstractCreateOrUpdateCustomPostMutationResolverBridge;

abstract class AbstractCreateUpdateEventMutationResolverBridge extends AbstractCreateOrUpdateCustomPostMutationResolverBridge
{
    /**
     * @param array<string,mixed> $mutationData
     */
    public function addMutationDataForFieldDataAccessor(array &$mutationData): void
    {
        parent::addMutationDataForFieldDataAccessor($mutationData);

        $mutationData['location'] = $this->getComponentProcessorManager()->getComponentProcessor([PoP_Module_Processor_SelectableTypeaheadMapFormComponents::class, PoP_Module_Processor_SelectableTypeaheadMapFormComponents::COMPONENT_EM_FORMCOMPONENT_SINGLELOCATIONTYPEAHEADMAP])->getValue([PoP_Module_Processor_SelectableTypeaheadMapFormComponents::class, PoP_Module_Processor_SelectableTypeaheadMapFormComponents::COMPONENT_EM_FORMCOMPONENT_SINGLELOCATIONTYPEAHEADMAP]);
        $mutationData['when'] = $this->getComponentProcessorManager()->getComponentProcessor([PoP_Module_Processor_DateRangeComponentInputs::class, PoP_Module_Processor_DateRangeComponentInputs::COMPONENT_FORMINPUT_DATERANGETIMEPICKER])->getValue([PoP_Module_Processor_DateRangeComponentInputs::class, PoP_Module_Processor_DateRangeComponentInputs::COMPONENT_FORMINPUT_DATERANGETIMEPICKER]);
    }

    /**
     * @param array<string,mixed> $data_properties
     */
    protected function modifyDataProperties(array &$data_properties, string|int $result_id): void
    {
        parent::modifyDataProperties($data_properties, $result_id);
        $data_properties[DataloadingConstants::QUERYARGS]['status'] = array('pending', 'draft', 'publish');
    }
}
