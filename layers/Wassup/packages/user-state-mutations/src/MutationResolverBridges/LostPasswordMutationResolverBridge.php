<?php

declare(strict_types=1);

namespace PoPSitesWassup\UserStateMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolverBridges\AbstractComponentMutationResolverBridge;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP\ComponentModel\QueryInputOutputHandlers\ResponseConstants;
use PoP\Engine\Route\RouteUtils;
use PoP_Module_Processor_LoginTextFormInputs;
use PoPSitesWassup\UserStateMutations\MutationResolvers\LostPasswordMutationResolver;
use PoPSitesWassup\UserStateMutations\Constants\MutationInputProperties;

class LostPasswordMutationResolverBridge extends AbstractComponentMutationResolverBridge
{
    private ?LostPasswordMutationResolver $lostPasswordMutationResolver = null;

    final protected function getLostPasswordMutationResolver(): LostPasswordMutationResolver
    {
        if ($this->lostPasswordMutationResolver === null) {
            /** @var LostPasswordMutationResolver */
            $lostPasswordMutationResolver = $this->instanceManager->getInstance(LostPasswordMutationResolver::class);
            $this->lostPasswordMutationResolver = $lostPasswordMutationResolver;
        }
        return $this->lostPasswordMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getLostPasswordMutationResolver();
    }

    /**
     * @param array<string,mixed> $mutationData
     */
    public function addMutationDataForFieldDataAccessor(array &$mutationData): void
    {
        $mutationData[MutationInputProperties::USERNAME_OR_EMAIL] = $this->getComponentProcessorManager()->getComponentProcessor([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::COMPONENT_FORMINPUT_LOSTPWD_USERNAME])->getValue([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::COMPONENT_FORMINPUT_LOSTPWD_USERNAME]);
    }

    /**
     * @return array<string,mixed>|null
     * @param array<string,mixed> $data_properties
     */
    public function executeMutation(array &$data_properties): ?array
    {
        $executed = parent::executeMutation($data_properties);
        if ($executed && is_array($executed) && $executed[ResponseConstants::SUCCESS]) {
            // Redirect to the "Reset password" page
            $executed[GD_DATALOAD_QUERYHANDLERRESPONSE_SOFTREDIRECT] = RouteUtils::getRouteURL(POP_USERLOGIN_ROUTE_LOSTPWDRESET);
        }
        return $executed;
    }
}
