<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Request\Channel;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use StadGent\Services\OpeningHours\Uri\Channel\GetAllUri;

/**
 * Request to get all Channels for the given Service ID.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
final class GetAllRequest extends AbstractJsonRequest
{
    /**
     * Get all channels for a service by the Service ID.
     *
     * @param int $serviceId
     *   The Service ID to get all channels for.
     */
    public function __construct(int $serviceId)
    {
        $uri = new GetAllUri($serviceId);
        parent::__construct($uri);
    }
}
