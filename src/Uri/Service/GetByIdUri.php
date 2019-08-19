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
     * @param int $id
     *   The Service ID.
     */
    public function __construct($id)
    {
        $uri = sprintf('services/%d', $id);
        parent::__construct($uri);
    }
}
