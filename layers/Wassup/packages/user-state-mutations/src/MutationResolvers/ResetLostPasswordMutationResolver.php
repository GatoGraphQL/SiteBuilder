<?php

declare(strict_types=1);

namespace PoPSitesWassup\UserStateMutations\MutationResolvers;

use PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface;
use PoPSitesWassup\UserStateMutations\Constants\MutationInputProperties;
use PoPSitesWassup\UserStateMutations\MutationResolverUtils\MutationResolverUtils;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\ComponentModel\MutationResolvers\ErrorTypes;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\App;
use PoP\Root\Exception\AbstractException;
use PoP\Root\Exception\GenericClientException;
use PoP\UserAccount\FunctionAPIFactory;

class ResetLostPasswordMutationResolver extends AbstractMutationResolver
{
    private ?UserTypeAPIInterface $userTypeAPI = null;

    final protected function getUserTypeAPI(): UserTypeAPIInterface
    {
        if ($this->userTypeAPI === null) {
            /** @var UserTypeAPIInterface */
            $userTypeAPI = $this->instanceManager->getInstance(UserTypeAPIInterface::class);
            $this->userTypeAPI = $userTypeAPI;
        }
        return $this->userTypeAPI;
    }

    public function getErrorType(): int
    {
        return ErrorTypes::CODES;
    }

    public function validate(
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): void {
        $errorcodes = array();
        $code = $fieldDataAccessor->getValue(MutationInputProperties::CODE);
        $pwd = $fieldDataAccessor->getValue(MutationInputProperties::PASSWORD);
        $repeatpwd = $fieldDataAccessor->getValue(MutationInputProperties::REPEAT_PASSWORD);

        if (!$code) {
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
            $errorcodes[] = 'error-nocode';
        }
        if (!$pwd) {
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
            $errorcodes[] = 'error-nopwd';
        } elseif (strlen($pwd) < 8) {
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
            $errorcodes[] = 'error-short';
        }
        if (!$repeatpwd) {
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
            $errorcodes[] = 'error-norepeatpwd';
        }
        if ($pwd !== $repeatpwd) {
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
            $errorcodes[] = 'error-pwdnomatch';
        }
    }
    /**
     * @throws AbstractException In case of error
     */
    public function executeMutation(
        FieldDataAccessorInterface $fieldDataAccessor,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): mixed {
        $code = $fieldDataAccessor->getValue(MutationInputProperties::CODE);
        $pwd = $fieldDataAccessor->getValue(MutationInputProperties::PASSWORD);

        $cmsuseraccountapi = FunctionAPIFactory::getInstance();
        $decoded = MutationResolverUtils::decodeLostPasswordCode($code);
        $rp_key = $decoded['key'];
        $rp_login = $decoded['login'];

        if (!$rp_key || !$rp_login) {
            throw new GenericClientException($this->__('Wrong code', ''));
        }
        $user = $cmsuseraccountapi->checkPasswordResetKey($rp_key, $rp_login);

        // Do the actual password reset
        $cmsuseraccountapi->resetPassword($user, $pwd);

        $userID = $this->getUserTypeAPI()->getUserID($user);
        App::doAction('gd_lostpasswordreset', $userID);
        return $userID;
    }
}
