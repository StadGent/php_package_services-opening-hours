<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\RequestAbstract;

/**
 * Request to get OpenNow for a Channel in JSON format.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class OpenNowRequest extends RequestAbstract
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
        $uri = sprintf(
            'services/%d/channels/%d/open-now',
            (int) $serviceId,
            (int) $channelId
        );

        parent::__construct($uri);
    }
}
