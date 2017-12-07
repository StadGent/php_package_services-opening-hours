<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\RequestAbstract;
use StadGent\Services\OpeningHours\Uri\Channel\GetByIdUri;

/**
 * Request to get all Channels for the given Service Id.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class GetByIdRequest extends RequestAbstract
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
        $uri = new GetByIdUri($serviceId, $channelId);
        parent::__construct($uri);
    }
}
