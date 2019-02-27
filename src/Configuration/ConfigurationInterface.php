<?php

namespace StadGent\Services\OpeningHours\Configuration;

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
     * @param string $key
     *   The API key.
     * @param array $options
     *   Optional options about the service.
     */
    public function __construct($endPointUri, $key, array $options = []);

    /**
     * Get the endpoint URI.
     *
     * @return string
     *   The endpoint URI.
     */
    public function getUri();

    /**
     * Get the API key.
     *
     * @return string
     *   The API key.
     */
    public function getKey();

    /**
     * Get the timeout when calling the endpoint.
     *
     * @return int
     *   Timeout in seconds.
     */
    public function getTimeout();
}
