<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\MethodType;
use StadGent\Services\OpeningHours\Request\RequestAbstract;

/**
 * Get the OpeningHours for a single week as HTML.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class OpeningHoursWeekHtmlRequest extends RequestAbstract
{
    /**
     * Get the OpeningHours for a single week by the Service & Channel ID.
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

        parent::__construct(
            MethodType::GET,
            $uri,
            ['Accept' => AcceptType::HTML]
        );
    }
}
