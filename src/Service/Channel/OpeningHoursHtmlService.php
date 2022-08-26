<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Service\Channel;

use Exception;
use StadGent\Services\OpeningHours\Service\ServiceAbstract;
use Psr\Http\Message\RequestInterface;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowHtmlRequest;
use StadGent\Services\OpeningHours\Response\HtmlResponse;

/**
 * Service to access the Channel OpeningHours.
 *
 * @package StadGent\Services\OpeningHours
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
final class OpeningHoursHtmlService extends ServiceAbstract implements OpeningHoursHtmlServiceInterface
{
    /**
     * @inheritDoc
     */
    public function getOpenNow(int $serviceId, int $channelId): string
    {
        try {
            /** @var \StadGent\Services\OpeningHours\Response\HtmlResponse $response */
            $response = $this->send(
                new OpenNowHtmlRequest($serviceId, $channelId),
                HtmlResponse::class
            );
        } catch (Exception $e) {
            throw ExceptionFactory::fromException($e);
        }

        return $response->getHtml();
    }

    /**
     * @inheritDoc
     */
    public function getDay(int $serviceId, int $channelId, string $date): string
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
     * @inheritDoc
     */
    public function getWeek(int $serviceId, int $channelId, string $date): string
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
     * @inheritDoc
     */
    public function getMonth(int $serviceId, int $channelId, string $date): string
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
     * @inheritDoc
     */
    public function getYear(int $serviceId, int $channelId, string $date): string
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
     * @inheritDoc
     */
    public function getPeriod(int $serviceId, int $channelId, string $dateFrom, string $dateUntil): string
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
     * @param \Psr\Http\Message\RequestInterface $request
     *   The request to send.
     *
     * @return string
     *   The HTML.
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     */
    protected function sendHtmlRequest(string $cacheKey, RequestInterface $request): string
    {
        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            /** @var \StadGent\Services\OpeningHours\Response\HtmlResponse $response */
            $response = $this->send($request, HtmlResponse::class);
        } catch (Exception $e) {
            throw ExceptionFactory::fromException($e);
        }

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
    protected function createCacheKeyFromArray(array $parts): string
    {
        $key = 'channel:html:' . implode(':', $parts);
        return $this->createCacheKey($key);
    }
}
