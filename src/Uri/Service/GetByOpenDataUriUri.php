<?php

namespace StadGent\Services\OpeningHours\Uri\Service;

use DigipolisGent\API\Client\Uri\Uri;

/**
 * Uri to get a single service by its open data URI.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class GetByOpenDataUriUri extends Uri
{
    /**
     * Construct the URI.
     *
     * @param string $openDataUri
     *   The Service open data URI.
     */
    public function __construct($openDataUri)
    {
        $uri = sprintf('services?uri=%s', $openDataUri);
        parent::__construct($uri);
    }
}
