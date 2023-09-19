<?php

declare(strict_types=1);

namespace PoPSitesWassup\LocationMutations\MutationResolvers;

use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\Root\App;
use PoP\Root\Exception\AbstractException;
use PoP\Root\Exception\GenericSystemException;
use PoP_Locations_APIFactory;
use PoPCMSSchema\Locations\TypeAPIs\LocationTypeAPIInterface;

class CreateLocationMutationResolver extends AbstractMutationResolver
{
    private ?LocationTypeAPIInterface $locationTypeAPI = null;

    final public function setLocationTypeAPI(LocationTypeAPIInterface $locationTypeAPI): void
    {
        $this->locationTypeAPI = $locationTypeAPI;
    }
    final protected function getLocationTypeAPI(): LocationTypeAPIInterface
    {
        if ($this->locationTypeAPI === null) {
            /** @var LocationTypeAPIInterface */
            $locationTypeAPI = $this->instanceManager->getInstance(LocationTypeAPIInterface::class);
            $this->locationTypeAPI = $locationTypeAPI;
        }
        return $this->locationTypeAPI;
    }

    /**
     * @throws AbstractException In case of error
     */
    public function executeMutation(
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        // Allow EM PoP to initialize the field names as it needs them to populate the object in function getPost($validate = true),
        // in file plugins/events-manager/classes/em-location.php
        App::doAction('create_location');

        $pluginapi = PoP_Locations_APIFactory::getInstance();
        $location = $pluginapi->getNewLocationObject();

        // Load from $_POST and Validate
        if ($pluginapi->getPost($location) && $pluginapi->save($location)) { //EM_location gets the location if submitted via POST and validates it (safer than to depend on JS)
            return $this->getLocationTypeAPI()->getID($location);
        }
        if ($errors = $pluginapi->getErrors($location)) {
            throw new GenericSystemException(
                sprintf(
                    $this->__('Creating the location has failed, due to: \'%s\'', ''),
                    implode($this->__('\', \'', ''), $errors)
                )
            );
        }
        return false;
    }
}
