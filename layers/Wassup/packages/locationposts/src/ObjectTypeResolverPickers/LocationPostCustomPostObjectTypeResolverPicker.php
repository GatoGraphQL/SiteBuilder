<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPosts\ObjectTypeResolverPickers\CustomPostObjectTypeResolverPickerInterface;
use PoPCMSSchema\CustomPosts\TypeResolvers\UnionType\CustomPostUnionTypeResolver;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;

class LocationPostCustomPostObjectTypeResolverPicker extends AbstractLocationPostObjectTypeResolverPicker implements CustomPostObjectTypeResolverPickerInterface
{
    /**
     * @return array<class-string<UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo(): array
    {
        return [
            CustomPostUnionTypeResolver::class,
        ];
    }

    public function getCustomPostType(): string
    {
        return \POP_LOCATIONPOSTS_POSTTYPE_LOCATIONPOST;
    }
}
