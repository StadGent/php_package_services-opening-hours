<?php

namespace StadGent\Services\OpeningHours\Uri\Channel;

use DigipolisGent\API\Client\Uri\Uri;

/**
 * Uri to get open status for now.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class OpenNowUri extends Uri
{
    /**
     * Construct the OpenNow URI.
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
