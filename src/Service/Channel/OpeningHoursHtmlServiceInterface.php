<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Service\Channel;

use DigipolisGent\API\Service\ServiceInterface;

/**
 * Service to access the Channel OpeningHours.
 *
 * @package StadGent\Services\OpeningHours
 */
interface OpeningHoursHtmlServiceInterface extends ServiceInterface
{
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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getOpenNow(int $serviceId, int $channelId): string;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getDay(int $serviceId, int $channelId, string $date): string;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getWeek(int $serviceId, int $channelId, string $date): string;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getMonth(int $serviceId, int $channelId, string $date): string;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getYear(int $serviceId, int $channelId, string $date): string;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getPeriod(int $serviceId, int $channelId, string $dateFrom, string $dateUntil): string;
}
