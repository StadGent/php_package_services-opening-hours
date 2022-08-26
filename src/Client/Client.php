<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Client;

use DigipolisGent\API\Client\AbstractClient;
use Psr\Http\Message\RequestInterface;

/**
 * The client to connect to the API.
 *
 * @package StadGent\Services\OpeningHours\Client
 */
final class Client extends AbstractClient
{
    /**
     * {@inheritdoc}
     */
    protected function injectHeaders(RequestInterface $request): RequestInterface
    {
        /** @var \StadGent\Services\OpeningHours\Configuration\ConfigurationInterface $configuration */
        $configuration = $this->configuration;

        return parent::injectHeaders($request)
            ->withHeader('user-key', $configuration->getKey());
    }
}
