<?php

namespace StadGent\Services\OpeningHours\Uri\Service;

use DigipolisGent\API\Client\Uri\Uri;

/**
 * Uri to get a single service by its ID.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class GetByIdUri extends Uri
{
    /**
     * Construct the URI.
     *
     * @param int $serviceId
     *   The Service ID.
     */
    public function __construct($serviceId)
    {
        $uri = sprintf('services/%d', $serviceId);
        parent::__construct($uri);
    }
}
