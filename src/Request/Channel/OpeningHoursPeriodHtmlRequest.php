<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\HtmlRequestAbstract;
use StadGent\Services\OpeningHours\Uri\Channel\OpeningHoursPeriodUri;

/**
 * Get the OpeningHours for a given period as HTML.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class OpeningHoursPeriodHtmlRequest extends HtmlRequestAbstract
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
    public function __construct($serviceId, $channelId, $dateFrom, $dateUntil)
    {
        $uri = new OpeningHoursPeriodUri($serviceId, $channelId, $dateFrom, $dateUntil);
        parent::__construct($uri);
    }
}
