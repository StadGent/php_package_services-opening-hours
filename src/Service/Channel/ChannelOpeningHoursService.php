<?php

namespace StadGent\Services\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Cache\CacheableInterface;
use StadGent\Services\OpeningHours\Cache\CacheableTrait;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowRequest;
use StadGent\Services\OpeningHours\Request\RequestInterface;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use StadGent\Services\OpeningHours\Response\OpenNowResponse;
use StadGent\Services\OpeningHours\Service\ServiceAbstract;

/**
 * Service to access the Channel OpeningHours.
 *
 * @package StadGent\Services\OpeningHours
 */
class ChannelOpeningHoursService extends ServiceAbstract implements CacheableInterface
{
    use CacheableTrait;

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
    public function getOpenNow($serviceId, $channelId)
    {
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
        return $response->getOpenNow();
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
    public function getDay($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['day', $serviceId, $channelId, $date]
        );

        return $this->sendOpeninghoursRequest(
            $cacheKey,
            new OpeningHoursDayRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Get the Opening Hours for a single week as Value object.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     * @param string $date
     *   A date (Y-m-d) in the week to get the data for.
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
    public function getWeek($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['week', $serviceId, $channelId, $date]
        );

        return $this->sendOpeninghoursRequest(
            $cacheKey,
            new OpeningHoursWeekRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Get the Opening Hours for a single month as Value object.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     * @param string $date
     *   A date (Y-m-d) in the month to get the data for.
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
    public function getMonth($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['month', $serviceId, $channelId, $date]
        );

        return $this->sendOpeninghoursRequest(
            $cacheKey,
            new OpeningHoursMonthRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Get the Opening Hours for a single year as Value object.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     * @param string $date
     *   A date (Y-m-d) in the year to get the data for.
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
    public function getYear($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['year', $serviceId, $channelId, $date]
        );

        return $this->sendOpeninghoursRequest(
            $cacheKey,
            new OpeningHoursYearRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Get the Opening Hours for a given period as Value object.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     * @param string $dateFrom
     *   The start date (Y-m-d) of the period to get the data for.
     * @param string $dateUntil
     *   The end date (Y-m-d) of the period to get the data for.
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
    public function getPeriod($serviceId, $channelId, $dateFrom, $dateUntil)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['period', $serviceId, $channelId, $dateFrom, $dateUntil]
        );

        return $this->sendOpeninghoursRequest(
            $cacheKey,
            new OpeningHoursPeriodRequest($serviceId, $channelId, $dateFrom, $dateUntil)
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
