<?php

namespace StadGent\Services\OpeningHours\Request\Service;

use DigipolisGent\API\Client\Request\AbstractRequest;
use StadGent\Services\OpeningHours\Uri\Service\GetByOpenDataUriUri;

/**
 * Request to get a Service by its open data URI.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
class GetByOpenDataUriRequest extends AbstractRequest
{
    /**
     * Get a single Service by its open data URI.
     *
     * @param string $openDataUri
     *   The Service open data URI.
     */
    public function __construct($openDataUri)
    {
        $uri = new GetByOpenDataUriUri($openDataUri);
        parent::__construct($uri);
    }
}
