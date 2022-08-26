<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Request\Channel;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use StadGent\Services\OpeningHours\Uri\Channel\GetByIdUri;

/**
 * Request to get all Channels for the given Service ID.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
final class GetByIdRequest extends AbstractJsonRequest
{
    /**
     * Get all channels for a service by the Service & Channel ID.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     */
    public function __construct(int $serviceId, int $channelId)
    {
        $uri = new GetByIdUri($serviceId, $channelId);
        parent::__construct($uri);
    }
}
