<?php

namespace StadGent\Services\OpeningHours\Configuration;

use DigipolisGent\API\Client\Configuration\ConfigurationInterface as BaseConfigurationInterface;

/**
 * Configuration Interface.
 *
 * @package StadGent\Services\OpeningHours\Client\Configuration
 */
interface ConfigurationInterface extends BaseConfigurationInterface
{
    /**
     * Get the API key.
     *
     * @return string
     *   The API key.
     */
    public function getKey();
}
