<?php

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\Uri;

/**
 * Uri to get openinghours for a given period.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class OpeningHoursPeriodUri extends Uri
{
    /**
     * Construct the Month URI.
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
    public function __construct($serviceId, $channelId, $dateFrom, $dateUntil)
    {
        $uri = sprintf(
            'services/%d/channels/%d/openinghours?from=%s&until=%s',
            (int) $serviceId,
            (int) $channelId,
            $dateFrom,
            $dateUntil
        );
        parent::__construct($uri);
    }
}
