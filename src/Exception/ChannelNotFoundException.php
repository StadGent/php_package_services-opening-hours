<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Exception;

use GuzzleHttp\Exception\RequestException;

/**
 * Channel Not Found Exception.
 *
 * @package StadGent\Services\OpeningHours\Response\Exception
 */
final class ChannelNotFoundException extends ExceptionWithResponseAbstract
{
    /**
     * @inheritdoc
     */
    public static function fromException(RequestException $exception): ChannelNotFoundException
    {
        $result = new self(
            'The requested Channel was not found.',
            404,
            $exception
        );
        $result->setResponse($exception->getResponse());
        return $result;
    }
}
