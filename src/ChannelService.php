<?php

namespace StadGent\Services\OpeningHours;

use StadGent\Services\OpeningHours\Cache\CacheableInterface;
use StadGent\Services\OpeningHours\Cache\CacheableTrait;
use StadGent\Services\OpeningHours\Request\Channel\GetAllByServiceIdRequest;
use StadGent\Services\OpeningHours\Request\Channel\GetByServiceAndChannelIdRequest;
use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\OpeningHours\Response\ChannelsResponse;

/**
 * Service to access the Channels related API.
 *
 * @package StadGent\Services\OpeningHours
 */
class ChannelService extends ServiceAbstract implements CacheableInterface
{
    use CacheableTrait;

    /**
     * Get all Channels for the given Service Id.
     *
     * @param int $serviceId
     *   The ID of the Service to get all Channels for.
     *
     * @return \StadGent\Services\OpeningHours\Value\ChannelCollection
     *   The Channels linked to the Service.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    public function getAllByServiceId($serviceId)
    {
        $cacheKey = $this->createCacheKey(__FUNCTION__ . ':' . $serviceId);

        // From cache?
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        // Get from service.
        /* @var $response \StadGent\Services\OpeningHours\Response\ChannelsResponse */
        $response = $this->send(
            new GetAllByServiceIdRequest($serviceId),
            ChannelsResponse::class
        );

        $channels = $response->getChannels();
        $this->cacheSet($cacheKey, $channels);
        return $channels;
    }

    /**
     * Get a single Channel by its Service & Channel ID.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     *
     * @return \StadGent\Services\OpeningHours\Value\Channel
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    public function getByServiceAndChannelId($serviceId, $channelId)
    {
        $cacheKey = $this->createCacheKey(
            __FUNCTION__ . ':' . $serviceId . ':' . $channelId
        );

        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        // Get from service.
        $response = $this->send(
            new GetByServiceAndChannelIdRequest($serviceId, $channelId),
            ChannelResponse::class
        );

        /* @var $response \StadGent\Services\OpeningHours\Response\ChannelResponse */
        $channel = $response->getChannel();
        $this->cacheSet($cacheKey, $channel);

        return $channel;
    }
}
