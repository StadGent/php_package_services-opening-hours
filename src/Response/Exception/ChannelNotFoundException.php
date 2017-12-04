<?php

namespace StadGent\Services\OpeningHours\Response\Exception;

use Psr\Http\Message\ResponseInterface;

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
    public static function fromResponse(ResponseInterface $response)
    {
        $exception = new static(
            'The requested Channel was not found.',
            $response->getStatusCode()
        );
        $exception->setResponse($response);
        return $exception;
    }
}
