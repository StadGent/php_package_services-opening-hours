<?php

namespace StadGent\Services\OpeningHours;

use StadGent\Services\OpeningHours\Cache\CacheableInterface;
use StadGent\Services\OpeningHours\Cache\CacheableTrait;
use StadGent\Services\OpeningHours\Request\Channel\GetAllByServiceIdRequest;
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
     * @return \StadGent\Services\OpeningHours\Value\ChannelCollection
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
}
