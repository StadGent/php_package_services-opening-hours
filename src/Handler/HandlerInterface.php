<?php

namespace StadGent\Services\OpeningHours\Handler;

use StadGent\Services\OpeningHours\Response\ResponseInterface;
use Psr\Http\Message as Psr;

/**
 * Handlers transform PSR7-Response object to GentServices Response objects
 *
 * @package StadGent\Services\OpeningHours\Handler
 */
interface HandlerInterface
{
    /**
     * Returns the classname of the request this handler handles.
     *
     * eg: ServiceGetAll::Class
     *
     * @return string
     */
    public function handles();

    /**
     * Converts a Response from the http client to the corresponding Response.
     *
     * @param Psr\ResponseInterface $response
     *   The response to convert.
     *
     * @return ResponseInterface
     *   The proper Response.
     */
    public function toResponse(Psr\ResponseInterface $response);
}
