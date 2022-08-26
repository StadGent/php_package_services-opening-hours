<?php

declare(strict_types=1);

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
     *
     * @throws \JsonException
     */
    protected function getBodyData(Psr\ResponseInterface $response): array
    {
        $raw = (string) $response->getBody();
        return json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
    }
}
