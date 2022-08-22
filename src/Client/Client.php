<?php

namespace StadGent\Services\OpeningHours\Client;

use DigipolisGent\API\Client\AbstractClient;
use Psr\Http\Message\RequestInterface;

/**
 * The client to connect to the API.
 *
 * @package StadGent\Services\OpeningHours\Client
 */
class Client extends AbstractClient
{
    /**
     * {@inheritdoc}
     */
    protected function injectHeaders(RequestInterface $request)
    {
        return parent::injectHeaders($request)
            ->withHeader('user-key', $this->configuration->getKey());
    }
}
