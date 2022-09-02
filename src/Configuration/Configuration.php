<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Configuration;

use DigipolisGent\API\Client\Configuration\Configuration as BaseConfiguration;

/**
 * Class Configuration
 *
 * @package StadGent\Services\OpeningHours\Client\Configuration
 */
final class Configuration extends BaseConfiguration implements ConfigurationInterface
{
    /**
     * The API key.
     *
     * @var string|null
     */
    private ?string $key;

    /**
     * @inheritDoc
     */
    public function __construct(string $endpointUri, ?string $key = null, array $options = [])
    {
        parent::__construct($endpointUri, $options);
        $this->key = $key;
    }

    /**
     * @inheritDoc
     */
    public function getKey(): ?string
    {
        return $this->key;
    }
}
