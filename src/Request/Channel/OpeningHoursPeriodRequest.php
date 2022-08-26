<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Request\Channel;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use StadGent\Services\OpeningHours\Uri\Channel\OpeningHoursPeriodUri;

/**
 * Get the OpeningHours for a given period as JSON.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
final class OpeningHoursPeriodRequest extends AbstractJsonRequest
{
    /**
     * Get the OpeningHours for a given period by the Service & Channel ID.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     * @param string $dateFrom
     *   The start date (in Y-m-d format) of the period.
     * @param string $dateUntil
     *   The end date (in Y-m-d format) of the period.
     */
    public function __construct(int $serviceId, int $channelId, string $dateFrom, string $dateUntil)
    {
        $uri = new OpeningHoursPeriodUri($serviceId, $channelId, $dateFrom, $dateUntil);
        parent::__construct($uri);
    }
}
