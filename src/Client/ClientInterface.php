<?php

namespace StadGent\Services\OpeningHours\Client;

use StadGent\Services\OpeningHours\Handler\HandlerInterface;
use StadGent\Services\OpeningHours\Request\RequestInterface;
use StadGent\Services\OpeningHours\Response\ResponseInterface;


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
     * @return ResponseInterface
     *   The response of the service call.
     */
    public function send(RequestInterface $request);

    /**
     * Adds a Handler to the Client.
     *
     * @param HandlerInterface $handler
     * @return ClientInterface
     */
    public function addHandler(HandlerInterface $handler);
}
