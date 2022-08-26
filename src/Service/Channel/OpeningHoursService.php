<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Service\Channel;

use Exception;
use StadGent\Services\OpeningHours\Service\ServiceAbstract;
use Psr\Http\Message\RequestInterface;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowRequest;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use StadGent\Services\OpeningHours\Response\OpenNowResponse;
use StadGent\Services\OpeningHours\Value\OpeningHours;
use StadGent\Services\OpeningHours\Value\OpenNow;

/**
 * Service to access the Channel OpeningHours.
 *
 * @package StadGent\Services\OpeningHours
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
final class OpeningHoursService extends ServiceAbstract implements OpeningHoursServiceInterface
{
    /**
     * @inheritDoc
     */
    public function getOpenNow(int $serviceId, int $channelId): OpenNow
    {
        try {
            /** @var \StadGent\Services\OpeningHours\Response\OpenNowResponse $response */
            $response = $this->send(
                new OpenNowRequest($serviceId, $channelId),
                OpenNowResponse::class
            );
        } catch (Exception $e) {
            throw ExceptionFactory::fromException($e);
        }

        return $response->getOpenNow();
    }

    /**
     * @inheritDoc
     */
    public function getDay(int $serviceId, int $channelId, string $date): OpeningHours
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
     * @inheritDoc
     */
    public function getWeek(int $serviceId, int $channelId, string $date): OpeningHours
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
     * @inheritDoc
     */
    public function getMonth(int $serviceId, int $channelId, string $date): OpeningHours
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
     * @inheritDoc
     */
    public function getYear(int $serviceId, int $channelId, string $date): OpeningHours
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
     * @inheritDoc
     */
    public function getPeriod(int $serviceId, int $channelId, string $dateFrom, string $dateUntil): OpeningHours
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
     * @param \Psr\Http\Message\RequestInterface $request
     *   The request to send.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpeningHours
     *   The openinghours from the backend.
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     */
    protected function sendOpeninghoursRequest(string $cacheKey, RequestInterface $request): OpeningHours
    {
        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            /** @var \StadGent\Services\OpeningHours\Response\OpeningHoursResponse $response */
            $response = $this->send($request, OpeningHoursResponse::class);
        } catch (Exception $e) {
            throw ExceptionFactory::fromException($e);
        }

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
    protected function createCacheKeyFromArray(array $parts): string
    {
        $key = 'channel:value:' . implode(':', $parts);
        return $this->createCacheKey($key);
    }
}
