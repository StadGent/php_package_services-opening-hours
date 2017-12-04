<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\MethodType;
use StadGent\Services\OpeningHours\Request\RequestAbstract;

/**
 * Request to get all Channels for the given Service Id.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class GetByServiceAndChannelIdRequest extends RequestAbstract
{
    /**
     * Get all channels for a service by the Service & Channel Id.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     */
    public function __construct($serviceId, $channelId)
    {
        $uri = sprintf(
            'services/%d/channels/%d',
            (int) $serviceId,
            (int) $channelId
        );

        parent::__construct(
            MethodType::GET,
            $uri,
            ['Accept' => AcceptType::JSON]
        );
    }
}
