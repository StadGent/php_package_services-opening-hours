<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get openinghours for a given period.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class OpeningHoursPeriodUri extends BaseUri
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
    public function __construct(int $serviceId, int $channelId, string $dateFrom, string $dateUntil)
    {
        $this->uri = sprintf(
            'services/%d/channels/%d/openinghours?from=%s&until=%s',
            $serviceId,
            $channelId,
            $dateFrom,
            $dateUntil
        );
    }
}
