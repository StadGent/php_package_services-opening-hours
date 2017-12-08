<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\HtmlRequestAbstract;
use StadGent\Services\OpeningHours\Uri\Channel\OpenNowUri;

/**
 * Request to get OpenNow for a Channel in HTML format.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class OpenNowHtmlRequest extends HtmlRequestAbstract
{
    /**
     * Get all channels for a service by the Service & Channel ID.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     */
    public function __construct($serviceId, $channelId)
    {
        $uri = new OpenNowUri($serviceId, $channelId);
        parent::__construct($uri);
    }
}
