<?php

namespace StadGent\Services\OpeningHours\Exception;

use GuzzleHttp\Exception\RequestException;

/**
 * Service Not Found Exception.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
final class ServiceNotFoundException extends ExceptionWithResponseAbstract
{
    /**
     * @inheritdoc
     */
    public static function fromException(RequestException $exception)
    {
        $result = new static(
            'The requested Service was not found.',
            404,
            $exception
        );
        $result->setResponse($exception->getResponse());
        return $result;
    }
}
