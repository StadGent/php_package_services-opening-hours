<?php

namespace StadGent\Services\OpeningHours\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use Psr\Http\Message as Psr;

/**
 * Abstract base Handler.
 *
 * @package StadGent\Services\OpeningHours\Handler
 */
abstract class HandlerAbstract implements HandlerInterface
{
    /**
     * Get the array version of the response body.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    protected function getBodyData(Psr\ResponseInterface $response)
    {
        $raw = (string) $response->getBody();
        return json_decode($raw, true);
    }
}
