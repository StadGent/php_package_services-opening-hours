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
    public function __construct($endpointUri, array $options = [])
    {
        $this->endpointUri = $endpointUri;

        foreach ($options as $key => $value) {
            if (array_key_exists($key, $this->options)) {
                $this->options[$key] = $value;
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

    /**
     * @inheritDoc
     */
    public function getTimeout()
    {
        return $this->options['timeout'];
    }
}
