<?php

namespace StadGent\Services\OpeningHours\Uri;

/**
 * Interface to describe the request URI.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
interface UriInterface
{
    /**
     * Get the URI as string.
     *
     * @return string
     *   The URI string.
     */
    public function getUri();
}
