<?php

namespace StadGent\Services\OpeningHours\Cache;

use Psr\SimpleCache\CacheInterface;

/**
 * Class CacheableTrait.
 *
 * Use this trait to add cache to an object.
 *
 * @package StadGent\Services\OpeningHours\Cache
 */
trait CacheableTrait
{
    /**
     * The cache service.
     *
     * @var \Psr\SimpleCache\CacheInterface
     */
    protected $cache;

    /**
     * State for using cache or not.
     *
     * @var bool
     */
    protected $useCache = true;

    /**
     * Get the state of the cache.
     *
     * @return bool
     *   Is caching active or not.
     */
    public function useCache()
    {
        return $this->useCache;
    }

    /**
     * Set the cache service.
     *
     * @param \Psr\SimpleCache\CacheInterface $cache
     *   The cache to set.
     */
    public function setCacheService(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Store a value in the cache service.
     *
     * This will check if a cache service is set.
     * If not: the item will not be cached.
     *
     * @param string $key
     *   The cache key to store the value in.
     * @param mixed $value
     *   The value to cache.
     *
     * @return bool
     *   Item is cached.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   If the $key string is not a legal value.
     */
    protected function cacheSet($key, $value)
    {
        if (!$this->cache || !$this->useCache()) {
            return false;
        }

        return $this->cache->set($key, $value);
    }

    /**
     * Retrieve a value from the cache service.
     *
     * This will check if a cache service is set.
     * If not: this will return a cache miss (null).
     *
     * @param string $key
     *   The cache key to store the value in.
     * @param mixed $default
     *   The default value if the item is not cached.
     *
     * @return mixed
     *   Cached value or default if no cache for the item.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   If the $key string is not a legal value.
     */
    protected function cacheGet($key, $default = null)
    {
        if (!$this->cache || !$this->useCache()) {
            return null;
        }

        return $this->cache->get($key, $default);
    }

    /**
     * Helper to create a cache key.
     *
     * @param string $key
     *   The cache key that needs to be prefixed.
     *
     * @return string
     *   Prefixed cache key.
     */
    protected function createCacheKey($key)
    {
        return sprintf('OpeningHours:%s', $key);
    }
}
