<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventLinkMutations\MutationResolverBridges;

use PoP_Module_Processor_CreateUpdatePostTextFormInputs;
use PoPSitesWassup\EventMutations\MutationResolverBridges\AbstractCreateUpdateEventMutationResolverBridge;

abstract class AbstractCreateUpdateEventLinkMutationResolverBridge extends AbstractCreateUpdateEventMutationResolverBridge
{
    /**
     * Function below was copied from class GD_CreateUpdate_PostLink
     * @return mixed[]
     */
    protected function getEditorInput(): array
    {
        return [PoP_Module_Processor_CreateUpdatePostTextFormInputs::class, PoP_Module_Processor_CreateUpdatePostTextFormInputs::COMPONENT_CONTENTPOSTLINKS_FORMINPUT_LINK];
    }
}
