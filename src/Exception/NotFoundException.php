<?php

namespace StadGent\Services\OpeningHours\Exception;

use GuzzleHttp\Exception\RequestException;

/**
 * Generic Not Found Exception.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
class NotFoundException extends ExceptionWithResponseAbstract
{
    /**
     * @inheritdoc
     */
    public static function fromException(RequestException $e)
    {
        $exception = new static(
            'The requested item was not found.',
            404,
            $e
        );
        $exception->setResponse($e->getResponse());
        return $exception;
    }
}
