<?php

namespace StadGent\Services\OpeningHours\Response\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Service Not Found Exception.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
class ServiceNotFoundException extends ExceptionWithResponseAbstract
{
    /**
     * @inheritdoc
     */
    public static function fromResponse(ResponseInterface $response)
    {
        $exception = new static(
            'The requested Service was not found.',
            $response->getStatusCode()
        );
        $exception->setResponse($response);
        return $exception;
    }
}
