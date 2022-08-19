<?php

namespace StadGent\Services\OpeningHours\Request\Service;

use DigipolisGent\API\Client\Request\AbstractRequest;
use StadGent\Services\OpeningHours\Uri\Service\GetByIdUri;

/**
 * Request to get a Service by its ID.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
class GetByIdRequest extends AbstractRequest
{
    /**
     * Get a single Service by its ID.
     *
     * @param int $serviceId
     *   The Service ID.
     */
    public function __construct($serviceId)
    {
        $uri = new GetByIdUri($serviceId);
        parent::__construct($uri);
    }
}
