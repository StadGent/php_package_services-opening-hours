<?php

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\Uri;

/**
 * Uri to get openinghours for a given month.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class OpeningHoursMonthUri extends Uri
{
    /**
     * Construct the Month URI.
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
        $uri = sprintf(
            'services/%d/channels/%d/openinghours/month?date=%s',
            (int) $serviceId,
            (int) $channelId,
            $date
        );
        parent::__construct($uri);
    }
}
