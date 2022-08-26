<?php

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get open status for now.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class OpenNowUri extends BaseUri
{
    /**
     * Construct the OpenNow URI.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     */
    public function __construct(int $serviceId, int $channelId)
    {
        $this->uri = sprintf(
            'services/%d/channels/%d/open-now',
            $serviceId,
            $channelId
        );
    }
}
