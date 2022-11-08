<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Request\Service;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use StadGent\Services\OpeningHours\Uri\Service\GetBySourceIdUri;

/**
 * Request to get a Service by its source and source id.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
final class GetBySourceIdRequest extends AbstractJsonRequest
{
    /**
     * Get a single Service by its open data URI.
     *
     * @param string $source
     *   The source.
     * @param string $sourceId
     *   The source id.
     */
    public function __construct(string $source, string $sourceId)
    {
        $uri = new GetBySourceIdUri($source, $sourceId);
        parent::__construct($uri);
    }
}
