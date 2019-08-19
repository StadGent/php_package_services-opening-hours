<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use DigipolisGent\API\Client\Request\AbstractHtmlRequest;
use StadGent\Services\OpeningHours\Uri\Channel\OpeningHoursMonthUri;

/**
 * Get the OpeningHours for a single month as HTML.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class OpeningHoursMonthHtmlRequest extends AbstractHtmlRequest
{
    /**
     * Get the OpeningHours for a single month by the Service & Channel ID.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     * @param string $date
     *   The first day (date in Y-m-d format) to get the month overview for.
     */
    public function __construct($serviceId, $channelId, $date)
    {
        $uri = new OpeningHoursMonthUri($serviceId, $channelId, $date);
        parent::__construct($uri);
    }
}
