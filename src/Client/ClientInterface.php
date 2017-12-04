<?php

namespace StadGent\Services\OpeningHours\Client;

use StadGent\Services\OpeningHours\Handler\HandlerInterface;
use StadGent\Services\OpeningHours\Request\RequestInterface;

/**
 * Client Interface.
 *
 * This is a wrapper around the actual used HTTP request (Guzzle, ...).
 *
 * @package StadGent\Services\OpeningHours\Client
 */
interface ClientInterface
{
    /**
     * Perform a request to the API.
     *
     * @param RequestInterface $request
     *   The request parameters.
     *
     * @return \StadGent\Services\OpeningHours\Response\ResponseInterface
     *   The response of the service call.
     */
    public function send(RequestInterface $request);

    /**
     * Adds a Handler to the Client.
     *
     * @param \StadGent\Services\OpeningHours\Handler\HandlerInterface $handler
     *   The handler to add to the Client.
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     *   The client.
     */
    public function addHandler(HandlerInterface $handler);
}
