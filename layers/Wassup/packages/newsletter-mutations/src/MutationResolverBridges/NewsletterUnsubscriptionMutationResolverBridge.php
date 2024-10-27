<?php

declare(strict_types=1);

namespace PoPSitesWassup\NewsletterMutations\MutationResolverBridges;

use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
use PoP_Newsletter_Module_Processor_TextFormInputs;
use PoPSitesWassup\FormMutations\MutationResolverBridges\AbstractFormComponentMutationResolverBridge;
use PoPSitesWassup\NewsletterMutations\MutationResolvers\NewsletterUnsubscriptionMutationResolver;

class NewsletterUnsubscriptionMutationResolverBridge extends AbstractFormComponentMutationResolverBridge
{
    private ?NewsletterUnsubscriptionMutationResolver $newsletterUnsubscriptionMutationResolver = null;

    final protected function getNewsletterUnsubscriptionMutationResolver(): NewsletterUnsubscriptionMutationResolver
    {
        if ($this->newsletterUnsubscriptionMutationResolver === null) {
            /** @var NewsletterUnsubscriptionMutationResolver */
            $newsletterUnsubscriptionMutationResolver = $this->instanceManager->getInstance(NewsletterUnsubscriptionMutationResolver::class);
            $this->newsletterUnsubscriptionMutationResolver = $newsletterUnsubscriptionMutationResolver;
        }
        return $this->newsletterUnsubscriptionMutationResolver;
    }

    public function getMutationResolver(): MutationResolverInterface
    {
        return $this->getNewsletterUnsubscriptionMutationResolver();
    }

    /**
     * @param array<string,mixed> $mutationData
     */
    public function addMutationDataForFieldDataAccessor(array &$mutationData): void
    {
        $mutationData['email'] = $this->getComponentProcessorManager()->getComponentProcessor([PoP_Newsletter_Module_Processor_TextFormInputs::class, PoP_Newsletter_Module_Processor_TextFormInputs::COMPONENT_FORMINPUT_NEWSLETTEREMAILVERIFICATIONEMAIL])->getValue([PoP_Newsletter_Module_Processor_TextFormInputs::class, PoP_Newsletter_Module_Processor_TextFormInputs::COMPONENT_FORMINPUT_NEWSLETTEREMAILVERIFICATIONEMAIL]);
        $mutationData['verificationcode'] = $this->getComponentProcessorManager()->getComponentProcessor([PoP_Newsletter_Module_Processor_TextFormInputs::class, PoP_Newsletter_Module_Processor_TextFormInputs::COMPONENT_FORMINPUT_NEWSLETTEREMAILVERIFICATIONCODE])->getValue([PoP_Newsletter_Module_Processor_TextFormInputs::class, PoP_Newsletter_Module_Processor_TextFormInputs::COMPONENT_FORMINPUT_NEWSLETTEREMAILVERIFICATIONCODE]);
    }
}
