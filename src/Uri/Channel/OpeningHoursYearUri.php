<?php

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\Uri;

/**
 * Uri to get openinghours for a given year.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class OpeningHoursYearUri extends Uri
{
    /**
     * Construct the Year URI.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     * @param string $date
     *   The first day (date in Y-m-d format) to get the year overview for.
     */
    public function __construct($serviceId, $channelId, $date)
    {
        $uri = sprintf(
            'services/%d/channels/%d/openinghours/year?date=%s',
            (int) $serviceId,
            (int) $channelId,
            $date
        );
        parent::__construct($uri);
    }
}
