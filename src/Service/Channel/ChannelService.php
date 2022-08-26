<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Service\ServiceAbstract;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Request\Channel\GetAllRequest;
use StadGent\Services\OpeningHours\Request\Channel\GetByIdRequest;
use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\OpeningHours\Response\ChannelsResponse;
use StadGent\Services\OpeningHours\Value\Channel;
use StadGent\Services\OpeningHours\Value\ChannelCollection;

/**
 * Service to access the get Channel(s).
 *
 * @package StadGent\Services\OpeningHours
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
final class ChannelService extends ServiceAbstract implements ChannelServiceInterface
{
    /**
     * @inheritDoc
     */
    public function getAll(int $serviceId): ChannelCollection
    {
        $cacheKey = $this->createCacheKeyFromArray(['all', $serviceId]);

        // From cache?
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        // Get from service.
        try {
            /** @var \StadGent\Services\OpeningHours\Response\ChannelsResponse $response */
            $response = $this->send(
                new GetAllRequest($serviceId),
                ChannelsResponse::class
            );
        } catch (\Exception $e) {
            throw ExceptionFactory::fromException($e);
        }

        $channels = $response->getChannels();
        $this->cacheSet($cacheKey, $channels);
        return $channels;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $serviceId, int $channelId): Channel
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['id', $serviceId, $channelId]
        );

        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            /** @var \StadGent\Services\OpeningHours\Response\ChannelResponse $response */
            $response = $this->send(
                new GetByIdRequest($serviceId, $channelId),
                ChannelResponse::class
            );
        } catch (\Exception $e) {
            throw ExceptionFactory::fromException($e);
        }

        $channel = $response->getChannel();
        $this->cacheSet($cacheKey, $channel);

        return $channel;
    }

    /**
     * Helper to create a cache key.
     *
     * @param array $parts
     *   The cache key parts, will be added to the key separated by ":".
     *
     * @return string
     *   Prefixed cache key.
     */
    protected function createCacheKeyFromArray(array $parts): string
    {
        $key = 'channel:value:' . implode(':', $parts);
        return $this->createCacheKey($key);
    }
}
