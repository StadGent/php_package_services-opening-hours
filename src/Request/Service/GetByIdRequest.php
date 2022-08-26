<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Request\Service;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use StadGent\Services\OpeningHours\Uri\Service\GetByIdUri;

/**
 * Request to get a Service by its ID.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
final class GetByIdRequest extends AbstractJsonRequest
{
    /**
     * Get a single Service by its ID.
     *
     * @param int $serviceId
     *   The Service ID.
     */
    public function __construct(int $serviceId)
    {
        $uri = new GetByIdUri($serviceId);
        parent::__construct($uri);
    }
}
