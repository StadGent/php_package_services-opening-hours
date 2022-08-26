<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Cache;

/**
 * Class CacheKeyTrait.
 *
 * Use this trait to create a cache key.
 *
 * @package StadGent\Services\OpeningHours\Cache
 */
trait CacheKeyTrait
{
    /**
     * Helper to create a cache key.
     *
     * @param string $key
     *   The cache key that needs to be prefixed.
     *
     * @return string
     *   Prefixed cache key.
     */
    protected function createCacheKey(string $key): string
    {
        return sprintf('OpeningHours:%s', $key);
    }
}
