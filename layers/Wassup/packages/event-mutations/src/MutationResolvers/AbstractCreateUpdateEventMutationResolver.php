<?php

declare(strict_types=1);

namespace PoPSitesWassup\EventMutations\MutationResolvers;

use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use EM_Event;
use PoPCMSSchema\CustomPostMutations\Exception\CustomPostCRUDMutationException;
use PoPCMSSchema\EventMutations\TypeAPIs\EventTypeMutationAPIInterface;
use PoPCMSSchema\Events\TypeAPIs\EventTypeAPIInterface;
use PoPSitesWassup\CustomPostMutations\MutationResolvers\AbstractCreateOrUpdateCustomPostMutationResolver;

abstract class AbstractCreateUpdateEventMutationResolver extends AbstractCreateOrUpdateCustomPostMutationResolver
{
    private ?EventTypeAPIInterface $eventTypeAPI = null;
    private ?EventTypeMutationAPIInterface $eventTypeMutationAPI = null;

    final protected function getEventTypeAPI(): EventTypeAPIInterface
    {
        if ($this->eventTypeAPI === null) {
            /** @var EventTypeAPIInterface */
            $eventTypeAPI = $this->instanceManager->getInstance(EventTypeAPIInterface::class);
            $this->eventTypeAPI = $eventTypeAPI;
        }
        return $this->eventTypeAPI;
    }
    final protected function getEventTypeMutationAPI(): EventTypeMutationAPIInterface
    {
        if ($this->eventTypeMutationAPI === null) {
            /** @var EventTypeMutationAPIInterface */
            $eventTypeMutationAPI = $this->instanceManager->getInstance(EventTypeMutationAPIInterface::class);
            $this->eventTypeMutationAPI = $eventTypeMutationAPI;
        }
        return $this->eventTypeMutationAPI;
    }

    public function getCustomPostType(): string
    {
        return $this->getEventTypeAPI()->getEventCustomPostType();
    }
    protected function volunteer()
    {
        return true;
    }

    // Update Post Validation
    /**
     * @param string[] $errors
     * @todo Must migrate logic to `validateCreateUpdateErrors`
     */
    protected function validateContent(array &$errors, FieldDataAccessorInterface $fieldDataAccessor): void
    {
        parent::validateContent($errors, $fieldDataAccessor);

        // Validate for any status (even "draft"), since without date EM doesn't create the Event
        if (empty(array_filter(array_values($fieldDataAccessor->getValue('when'))))) {
            // @todo Migrate from string to FeedbackItemProvider
            // $objectTypeFieldResolutionFeedbackStore->addError(
            //     new ObjectTypeFieldResolutionFeedback(
            //         new FeedbackItemResolution(
            //             MutationErrorFeedbackItemProvider::class,
            //             MutationErrorFeedbackItemProvider::E1,
            //         ),
            //         $fieldDataAccessor->getField(),
            //     )
            // );
            $errors = [];
            $errors[] = $this->__('The dates/time cannot be empty', 'poptheme-wassup');
        }
    }

    protected function getCreateCustomPostData(FieldDataAccessorInterface $fieldDataAccessor): array
    {
        $customPostData = parent::getCreateCustomPostData($fieldDataAccessor);
        $customPostData = $this->getCreateUpdateEventData($customPostData, $fieldDataAccessor);
        return $customPostData;
    }

    protected function getUpdateCustomPostData(FieldDataAccessorInterface $fieldDataAccessor): array
    {
        $customPostData = parent::getUpdateCustomPostData($fieldDataAccessor);
        $customPostData = $this->getCreateUpdateEventData($customPostData, $fieldDataAccessor);
        return $customPostData;
    }

    /**
     * @param array<string,mixed> $customPostData
     */
    protected function getCreateUpdateEventData(array $customPostData, FieldDataAccessorInterface $fieldDataAccessor): array
    {
        $customPostData['when'] = $fieldDataAccessor->getValue('when');
        $customPostData['location'] = $fieldDataAccessor->getValue('location');
        return $customPostData;
    }

    /**
     * @param array<string,mixed> $customPostData
     */
    protected function populate(EM_Event &$EM_Event, array $customPostData): void
    {
        $this->getEventTypeMutationAPI()->populate($EM_Event, $customPostData);
    }

    /**
     * @param array<string,mixed> $customPostData
     */
    protected function save(EM_Event &$EM_Event, array $customPostData): string|int
    {
        $this->populate($EM_Event, $customPostData);
        $EM_Event->save();
        return $EM_Event->post_id;
    }

    /**
     * @param array<string,mixed> $customPostData
     * @return string|int the ID of the updated custom post
     * @throws CustomPostCRUDMutationException If there was an error (eg: Custom Post does not exist)
     */
    protected function executeUpdateCustomPost(array $customPostData): string|int
    {
        $EM_Event = new EM_Event($customPostData['id'], 'post_id');
        $eventPostID = $this->save($EM_Event, $customPostData);
        if ($eventPostID === 0) {
            throw new CustomPostCRUDMutationException(
                $this->__('There was an error updating the event', 'event-mutations')
            );
        }
        return $eventPostID;
    }

    /**
     * @param array<string,mixed> $data
     * @return string|int the ID of the created custom post
     * @throws CustomPostCRUDMutationException If there was an error (eg: some Custom Post creation validation failed)
     * @param array<string,mixed> $customPostData
     */
    protected function executeCreateCustomPost(array $customPostData): string|int
    {
        $EM_Event = new EM_Event();
        $eventPostID = $this->save($EM_Event, $customPostData);
        if ($eventPostID === 0) {
            throw new CustomPostCRUDMutationException(
                $this->__('There was an error creating the event', 'event-mutations')
            );
        }
        return $eventPostID;
    }
}
