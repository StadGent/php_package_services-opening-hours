<?php

namespace StadGent\Services\OpeningHours;

use StadGent\Services\OpeningHours\Cache\CacheableInterface;
use StadGent\Services\OpeningHours\Cache\CacheableTrait;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Request\Channel\GetAllRequest;
use StadGent\Services\OpeningHours\Request\Channel\GetByIdRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowRequest;
use StadGent\Services\OpeningHours\Request\RequestInterface;
use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\OpeningHours\Response\ChannelsResponse;
use StadGent\Services\OpeningHours\Response\HtmlResponse;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use StadGent\Services\OpeningHours\Response\OpenNowResponse;

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
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getAll($serviceId)
    {
        $cacheKey = $this->createCacheKeyFromArray([__FUNCTION__, $serviceId]);

        // From cache?
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        // Get from service.
        try {
            /* @var $response \StadGent\Services\OpeningHours\Response\ChannelsResponse */
            $response = $this->send(
                new GetAllRequest($serviceId),
                ChannelsResponse::class
            );
        } catch (\Exception $e) {
            ExceptionFactory::fromException($e);
        }

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
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getById($serviceId, $channelId)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            [__FUNCTION__, $serviceId, $channelId]
        );

        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            // Get from service.
            $response = $this->send(
                new GetByIdRequest($serviceId, $channelId),
                ChannelResponse::class
            );
        } catch (\Exception $e) {
            ExceptionFactory::fromException($e);
        }

        /* @var $response \StadGent\Services\OpeningHours\Response\ChannelResponse */
        $channel = $response->getChannel();
        $this->cacheSet($cacheKey, $channel);

        return $channel;
    }

    /**
     * Get the Open now status as Value object.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpenNow
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function openNow($serviceId, $channelId)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            [__FUNCTION__, $serviceId, $channelId]
        );

        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            // Get from service.
            $response = $this->send(
                new OpenNowRequest($serviceId, $channelId),
                OpenNowResponse::class
            );
        } catch (\Exception $e) {
            ExceptionFactory::fromException($e);
        }

        /* @var $response \StadGent\Services\OpeningHours\Response\OpenNowResponse */
        $openNow = $response->getOpenNow();
        $this->cacheSet($cacheKey, $openNow);

        return $openNow;
    }

    /**
     * Get the Open now status as HTML.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     *
     * @return string
     *   The HTML.
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function openNowHtml($serviceId, $channelId)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            [__FUNCTION__, $serviceId, $channelId]
        );

        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            // Get from service.
            $response = $this->send(
                new OpenNowHtmlRequest($serviceId, $channelId),
                HtmlResponse::class
            );
        } catch (\Exception $e) {
            ExceptionFactory::fromException($e);
        }

        /* @var $response \StadGent\Services\OpeningHours\Response\HtmlResponse */
        $html = $response->getHtml();
        $this->cacheSet($cacheKey, $html);

        return $html;
    }

    /**
     * Get the Opening Hours for a single day as Value object.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     * @param string $date
     *   The day date (Y-m-d) to get the data for.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpeningHours
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function openingHoursDay($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            [__FUNCTION__, $serviceId, $channelId, $date]
        );

        return $this->sendOpeninghoursRequest(
            $cacheKey,
            new OpeningHoursDayRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Get the Opening Hours for a single day as HTML.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     * @param string $date
     *   The day date (Y-m-d) to get the data for.
     *
     * @return string
     *   The HTML.
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function openingHoursDayHtml($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            [__FUNCTION__, $serviceId, $channelId, $date]
        );

        return $this->sendHtmlRequest(
            $cacheKey,
            new OpeningHoursDayHtmlRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Helper to send a request that will result in a openingHours value.
     *
     * @param string $cacheKey
     *   The cache key to retrieve & store the result.
     * @param \StadGent\Services\OpeningHours\Request\RequestInterface $request
     *   The request to send.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpeningHours
     *   The openinghours from the backend.
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    protected function sendOpeninghoursRequest($cacheKey, RequestInterface $request)
    {
        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            // Get from service.
            $response = $this->send($request, OpeningHoursResponse::class);
        } catch (\Exception $e) {
            ExceptionFactory::fromException($e);
        }

        /* @var $response \StadGent\Services\OpeningHours\Response\OpeningHoursResponse */
        $openingHours = $response->getOpeninghours();
        $this->cacheSet($cacheKey, $openingHours);
        return $openingHours;
    }

    /**
     * Helper to send a request that will result in a HTML.
     *
     * @param string $cacheKey
     *   The cache key to retrieve & store the result.
     * @param \StadGent\Services\OpeningHours\Request\RequestInterface $request
     *   The request to send.
     *
     * @return string
     *   The HTML.
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    protected function sendHtmlRequest($cacheKey, RequestInterface $request)
    {
        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            // Get from service.
            $response = $this->send($request, HtmlResponse::class);
        } catch (\Exception $e) {
            ExceptionFactory::fromException($e);
        }

        /* @var $response \StadGent\Services\OpeningHours\Response\HtmlResponse */
        $html = $response->getHtml();
        $this->cacheSet($cacheKey, $html);
        return $html;
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
    protected function createCacheKeyFromArray(array $parts)
    {
        $key = implode(':', $parts);
        return $this->createCacheKey($key);
    }
}
