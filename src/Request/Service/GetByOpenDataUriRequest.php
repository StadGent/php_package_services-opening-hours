<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Request\Service;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use StadGent\Services\OpeningHours\Uri\Service\GetByOpenDataUriUri;

/**
 * Request to get a Service by its open data URI.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
final class GetByOpenDataUriRequest extends AbstractJsonRequest
{
    /**
     * Get a single Service by its open data URI.
     *
     * @param string $openDataUri
     *   The Service open data URI.
     */
    public function __construct(string $openDataUri)
    {
        $uri = new GetByOpenDataUriUri($openDataUri);
        parent::__construct($uri);
    }
}
