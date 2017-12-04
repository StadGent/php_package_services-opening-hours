<?php

namespace StadGent\Services\OpeningHours\Response\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Generic NotFound Exception.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
class NotFoundException extends ExceptionWithResponseAbstract
{
    /**
     * @inheritdoc
     */
    public static function fromResponse(ResponseInterface $response)
    {
        $exception = new static(
            'The requested record was not found.',
            $response->getStatusCode()
        );
        $exception->setResponse($response);
        return $exception;
    }
}
