<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get openinghours for a given day (date).
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class OpeningHoursDayUri extends BaseUri
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
    public function __construct(int $serviceId, int $channelId, string $date)
    {
        $this->uri = sprintf(
            'services/%d/channels/%d/openinghours/day?date=%s',
            $serviceId,
            $channelId,
            $date
        );
    }
}
