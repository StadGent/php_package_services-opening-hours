<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Service\Channel;

use DigipolisGent\API\Service\ServiceInterface;
use StadGent\Services\OpeningHours\Value\OpeningHours;
use StadGent\Services\OpeningHours\Value\OpenNow;

/**
 * Service to access the Channel OpeningHours.
 *
 * @package StadGent\Services\OpeningHours
 */
interface OpeningHoursServiceInterface extends ServiceInterface
{
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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getOpenNow(int $serviceId, int $channelId): OpenNow;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getDay(int $serviceId, int $channelId, string $date): OpeningHours;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getWeek(int $serviceId, int $channelId, string $date): OpeningHours;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getMonth(int $serviceId, int $channelId, string $date): OpeningHours;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getYear(int $serviceId, int $channelId, string $date): OpeningHours;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getPeriod(int $serviceId, int $channelId, string $dateFrom, string $dateUntil): OpeningHours;
}
