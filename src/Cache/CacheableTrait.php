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
     * @var CacheInterface
     */
    protected $cache;

    /**
     * State for using cache or not.
     *
     * @var bool
     */
    protected $useCache = true;

    /**
     * Get useCache state.
     *
     * @return bool
     */
    public function useCache()
    {
        return $this->useCache;
    }

    /**
     * Set the cache service.
     *
     * @param CacheInterface $cache
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
        preg_match('/([^\\\]+)$/', __CLASS__, $matches);
        $className = $matches[0];
        return sprintf('OpeningHours:%s:%s', $className, $key);
    }

    /**
     * Disable use of cache.
     */
    public function withoutCache()
    {
        $clone = clone $this;
        $clone->useCache = false;
        return $clone;
    }
}
