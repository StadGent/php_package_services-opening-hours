<?php

namespace StadGent\Services\OpeningHours\Client\Configuration;

/**
 * Configuration Interface.
 *
 * @package StadGent\Services\OpeningHours\Client\Configuration
 */
interface ConfigurationInterface
{
    /**
     * ConfigurationInterface constructor.
     *
     * @param string $endPointUri
     *   The endpoint URI.
     * @param array $options
     *   Optional options about the service.
     */
    public function __construct($endPointUri, array $options = []);

    /**
     * Get the endpoint URI.
     *
     * @return string
     *   The endpoint URI.
     */
    public function getUri();

    /**
     * Get the timeout when calling the endpoint.
     *
     * @return int
     *   Timeout in seconds.
     */
    public function getTimeout();
}
