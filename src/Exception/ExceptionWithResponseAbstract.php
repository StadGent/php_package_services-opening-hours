<?php

namespace StadGent\Services\OpeningHours\Exception;

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
     * @inheritdoc
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
