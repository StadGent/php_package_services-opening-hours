<?php

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\Uri;

/**
 * Uri to get a Channels for a given Service and Channel ID.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class GetByIdUri extends Uri
{
    /**
     * Construct the URI from the Service ID.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The channel ID.
     */
    public function __construct($serviceId, $channelId)
    {
        $uri = sprintf(
            'services/%d/channels/%d',
            (int) $serviceId,
            (int) $channelId
        );
        parent::__construct($uri);
    }
}
