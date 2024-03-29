<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Exception;

use GuzzleHttp\Exception\RequestException;

/**
 * Generic Not Found Exception.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
final class NotFoundException extends ExceptionWithResponseAbstract
{
    /**
     * @inheritdoc
     */
    public static function fromException(RequestException $exception): NotFoundException
    {
        $result = new self(
            'The requested item was not found.',
            404,
            $exception
        );
        $result->setResponse($exception->getResponse());
        return $result;
    }
}
