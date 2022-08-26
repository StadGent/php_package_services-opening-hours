<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Exception;

use Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Response Exception.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
abstract class ExceptionWithResponseAbstract extends Exception implements ExceptionWithResponseInterface
{
    /**
     * The response object related to this exception.
     *
     * @var \Psr\Http\Message\ResponseInterface|null
     */
    private ?ResponseInterface $response = null;

    /**
     * Set the related response.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    protected function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    /**
     * @inheritdoc
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
