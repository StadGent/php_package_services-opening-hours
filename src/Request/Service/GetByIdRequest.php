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
     * @param int $service_id
     *   The Service ID.
     */
    public function __construct($service_id)
    {
        $uri = new GetByIdUri($service_id);
        parent::__construct($uri);
    }
}
