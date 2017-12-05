<?php

namespace StadGent\Services\OpeningHours\Exception;

use GuzzleHttp\Exception\RequestException;

/**
 * Interface for exceptions containing the response object.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
interface ExceptionWithResponseInterface
{
    /**
     * Generates an Exception from a request exception.
     *
     * @param \GuzzleHttp\Exception\RequestException $exception
     *   The request exception.
     *
     * @return static
     */
    public static function fromException(RequestException $exception);

    /**
     * Get te response object.
     *
     * @return \Psr\Http\Message\ResponseInterface|null
     *   The response object (if set).
     */
    public function getResponse();
}
