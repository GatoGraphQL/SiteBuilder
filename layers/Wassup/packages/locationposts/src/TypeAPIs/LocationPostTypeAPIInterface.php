<?php

declare(strict_types=1);

namespace PoPCMSSchema\LocationPosts\TypeAPIs;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
interface LocationPostTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type LocationPost
     */
    public function isInstanceOfLocationPostType(object $object): bool;
    /**
     * Get the locationPost with provided ID or, if it doesn't exist, null
     */
    public function getLocationPost(int|string $id): ?object;
    /**
     * Indicate if an locationPost with provided ID exists
     */
    public function locationPostExists(int|string $id): bool;
    /**
     * Get the locationPost with provided ID or, if it doesn't exist, null.
     * If param "status" in $query is not passed, it defaults to "publish"
     *
     * @return array<string|int>|object[]
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getLocationPosts(array $query, array $options = []): array;
}
