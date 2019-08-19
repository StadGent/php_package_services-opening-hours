<?php

namespace StadGent\Services\OpeningHours\Uri\Channel;

use DigipolisGent\API\Client\Uri\Uri;

/**
 * Uri to get openinghours for a given day (date).
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class OpeningHoursDayUri extends Uri
{
    /**
     * Construct the Day URI.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     * @param string $date
     *   The day (date in Y-m-d format) to get the opening hours for.
     */
    public function __construct($serviceId, $channelId, $date)
    {
        $uri = sprintf(
            'services/%d/channels/%d/openinghours/day?date=%s',
            (int) $serviceId,
            (int) $channelId,
            $date
        );
        parent::__construct($uri);
    }
}
