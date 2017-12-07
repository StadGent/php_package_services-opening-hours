<?php

namespace StadGent\Services\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Cache\CacheableInterface;
use StadGent\Services\OpeningHours\Cache\CacheableTrait;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowHtmlRequest;
use StadGent\Services\OpeningHours\Request\RequestInterface;
use StadGent\Services\OpeningHours\Response\HtmlResponse;
use StadGent\Services\OpeningHours\Service\ServiceAbstract;

/**
 * Service to access the Channel OpeningHours.
 *
 * @package StadGent\Services\OpeningHours
 */
class ChannelOpeningHoursHtmlService extends ServiceAbstract implements CacheableInterface
{
    use CacheableTrait;

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
    public function getOpenNow($serviceId, $channelId)
    {
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
        return $response->getHtml();
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
    public function getDay($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['day', $serviceId, $channelId, $date]
        );

        return $this->sendHtmlRequest(
            $cacheKey,
            new OpeningHoursDayHtmlRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Get the Opening Hours for a single week as HTML.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     * @param string $date
     *   A date (Y-m-d) in the week to get the data for.
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
    public function getWeek($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['week', $serviceId, $channelId, $date]
        );

        return $this->sendHtmlRequest(
            $cacheKey,
            new OpeningHoursWeekHtmlRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Get the Opening Hours for a single month as HTML.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     * @param string $date
     *   A date (Y-m-d) in the month to get the data for.
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
    public function getMonth($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['month', $serviceId, $channelId, $date]
        );

        return $this->sendHtmlRequest(
            $cacheKey,
            new OpeningHoursMonthHtmlRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Get the Opening Hours for a single year as HTML.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     * @param string $date
     *   A date (Y-m-d) in the year to get the data for.
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
    public function getYear($serviceId, $channelId, $date)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['year', $serviceId, $channelId, $date]
        );

        return $this->sendHtmlRequest(
            $cacheKey,
            new OpeningHoursYearHtmlRequest($serviceId, $channelId, $date)
        );
    }

    /**
     * Get the Opening Hours for a given period as HTML.
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
    public function getPeriod($serviceId, $channelId, $dateFrom, $dateUntil)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['period', $serviceId, $channelId, $dateFrom, $dateUntil]
        );

        return $this->sendHtmlRequest(
            $cacheKey,
            new OpeningHoursPeriodHtmlRequest($serviceId, $channelId, $dateFrom, $dateUntil)
        );
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
