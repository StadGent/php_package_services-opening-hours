<?php

namespace StadGent\Services\OpeningHours\Response\Exception;

use \Psr\Http\Message\ResponseInterface;

/**
 * Response Exception.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
abstract class ExceptionWithResponseAbstract extends \Exception implements ExceptionWithResponseInterface
{
    /**
     * The response object related to this exception.
     *
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;

    /**
     * Set the response object.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    protected function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->response;
    }
}
