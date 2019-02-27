<?php

namespace StadGent\Services\OpeningHours\Configuration;

/**
 * Class Configuration
 *
 * @package StadGent\Services\OpeningHours\Client\Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Endpoint URI for the service.
     *
     * @var string
     */
    private $endpointUri;

    /**
     * The API key.
     *
     * @var string
     */
    private $key;

    /**
     * The configuration options.
     *
     * @var array
     */
    private $options = [
        'timeout' => 20,
    ];

    /**
     * @inheritDoc
     */
    public function __construct($endpointUri, $key, array $options = [])
    {
        $this->endpointUri = $endpointUri;
        $this->key = $key;

        foreach ($options as $name => $value) {
            if (array_key_exists($name, $this->options)) {
                $this->options[$name] = $value;
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return $this->endpointUri;
    }

    public function getKey()
    {
        return $this->key;
    }


    /**
     * @inheritDoc
     */
    public function getTimeout()
    {
        return $this->options['timeout'];
    }
}
