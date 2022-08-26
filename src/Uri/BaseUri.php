<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;

/**
 * Request URI to be used to communicate with the server endpoint.
 */
abstract class BaseUri implements UriInterface
{
    /**
     * The URI string.
     *
     * @var string
     */
    protected string $uri;

    /**
     * Get the URI as string.
     *
     * @return string
     *   The URI.
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}
