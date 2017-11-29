<?php

namespace StadGent\Services\OpeningHours\Response\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface for exceptions containing the response object.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
interface ExceptionWithResponseInterface
{
    /**
     * Generates an Exception from a response object.
     *
     * @param \Psr\Http\Message\ResponseInterface
     *   The response object.
     *
     * @return static
     */
    public static function fromResponse(ResponseInterface $response);

    /**
     * Get te response object.
     *
     * @return \Psr\Http\Message\ResponseInterface|null
     *   The response object (if set).
     */
    public function getResponse();
}
