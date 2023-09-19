<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationPostLinkMutations\MutationResolverBridges;

use PoP_Module_Processor_CreateUpdatePostTextFormInputs;
use PoPSitesWassup\LocationPostMutations\MutationResolverBridges\AbstractCreateUpdateLocationPostMutationResolverBridge;

abstract class AbstractCreateUpdateLocationPostLinkMutationResolverBridge extends AbstractCreateUpdateLocationPostMutationResolverBridge
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
