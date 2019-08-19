<?php

namespace StadGent\Services\OpeningHours\Uri\Channel;

use DigipolisGent\API\Client\Uri\Uri;

/**
 * Uri to get openinghours for a given week.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class OpeningHoursWeekUri extends Uri
{
    /**
     * Construct the Month URI.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     * @param string $date
     *   The first day (date in Y-m-d format) to get the week overview for.
     */
    public function __construct($serviceId, $channelId, $date)
    {
        $uri = sprintf(
            'services/%d/channels/%d/openinghours/week?date=%s',
            (int) $serviceId,
            (int) $channelId,
            $date
        );
        parent::__construct($uri);
    }
}
