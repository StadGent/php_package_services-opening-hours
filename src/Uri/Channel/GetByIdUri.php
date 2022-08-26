<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get a Channels for a given Service and Channel ID.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class GetByIdUri extends BaseUri
{
    /**
     * Construct the URI from the Service ID.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The channel ID.
     */
    public function __construct(int $serviceId, int $channelId)
    {
        $this->uri = sprintf(
            'services/%d/channels/%d',
            $serviceId,
            $channelId
        );
    }
}
