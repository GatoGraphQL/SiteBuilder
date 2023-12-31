<?php

declare(strict_types=1);

namespace PoPSchema\StancesWP\Overrides\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPostsWP\ObjectTypeResolverPickers\CustomPostObjectTypeResolverPickerInterface;
use PoPCMSSchema\CustomPostsWP\ObjectTypeResolverPickers\NoCastCustomPostTypeResolverPickerTrait;
use PoPSchema\Stances\ObjectTypeResolverPickers\StanceCustomPostObjectTypeResolverPicker as UpstreamStanceCustomPostObjectTypeResolverPicker;

class StanceCustomPostObjectTypeResolverPicker extends UpstreamStanceCustomPostObjectTypeResolverPicker implements CustomPostObjectTypeResolverPickerInterface
{
    use NoCastCustomPostTypeResolverPickerTrait;
}
