<?php

namespace StadGent\Services\OpeningHours\Configuration;

use DigipolisGent\API\Client\Configuration\Configuration as BaseConfiguration;

/**
 * Class Configuration
 *
 * @package StadGent\Services\OpeningHours\Client\Configuration
 */
class Configuration extends BaseConfiguration implements ConfigurationInterface
{

    /**
     * The API key.
     *
     * @var string
     */
    private $key;

    /**
     * @inheritDoc
     */
    public function __construct($endpointUri, $key, array $options = [])
    {
        parent::__construct($endpointUri, $options);
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }
}
