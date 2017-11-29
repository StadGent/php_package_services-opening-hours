<?php

namespace StadGent\Services\OpeningHours\Response\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Exception thrown when a response is not catched by any validator.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
class InvalidResponseException extends ExceptionWithResponseAbstract
{
    /**
     * @inheritdoc
     */
    public static function fromResponse(ResponseInterface $response)
    {
        $exception = new static(
            sprintf(
                'Response with status code %s was unexpected.',
                $response->getStatusCode()
            ),
            $response->getStatusCode()
        );
        $exception->setResponse($response);
        return $exception;
    }
}
