<?php

namespace StadGent\Services\OpeningHours\Handler;

use Psr\Http\Message as Psr;
use StadGent\Services\OpeningHours\Response\HtmlResponse;

/**
 * Abstract base Handler.
 *
 * @package StadGent\Services\OpeningHours\Handler
 */
abstract class HtmlHandlerAbstract implements HandlerInterface
{
    /**
     * Get the HTML response from the response object.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *   The PSR response message.
     *
     * @return \StadGent\Services\OpeningHours\Response\HtmlResponse
     *
     * @throws \InvalidArgumentException
     */
    public function toResponse(Psr\ResponseInterface $response)
    {
        $data = $this->getBodyData($response);
        return new HtmlResponse($data);
    }

    /**
     * Get the array version of the response body.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *   The PSR response message.
     *
     * @return string
     */
    protected function getBodyData(Psr\ResponseInterface $response)
    {
        return (string) $response->getBody();
    }
}
