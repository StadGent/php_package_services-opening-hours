<?php

namespace StadGent\Services\OpeningHours\Exception;

use GuzzleHttp\Exception\RequestException;

/**
 * Channel Not Found Exception.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
class ChannelNotFoundException extends ExceptionWithResponseAbstract
{
    /**
     * @inheritdoc
     */
    public static function fromException(RequestException $e)
    {
        $exception = new static(
            'The requested Channel was not found.',
            404,
            $e
        );
        $exception->setResponse($e->getResponse());
        return $exception;
    }
}
