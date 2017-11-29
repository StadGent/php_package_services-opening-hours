<?php

namespace StadGent\Services\OpeningHours\Cache;

use Psr\SimpleCache\CacheInterface;

/**
 * Interface CacheableInterface.
 *
 * @package StadGent\Services\OpeningHours\Cache
 */
interface CacheableInterface
{
  /**
   * Set the cache service.
   *
   * @param CacheInterface $cache
   */
  public function setCacheService(CacheInterface $cache);
}
