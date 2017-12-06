<?php

namespace StadGent\Services\OpeningHours\Exception;

use GuzzleHttp\Exception\RequestException;

/**
 * Factory to create the proper exception based on the the client Exception.
 *
 * @package StadGent\Services\OpeningHours\Exception
 */
class ExceptionFactory
{
    /**
     * Create a new Exception (if required) for the given Exception.
     *
     * This allows us to wrap API exceptions to our own.
     *
     * @param \Exception $exception
     *   The exception to check and optionally transform.
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     */
    public static function fromException(\Exception $exception)
    {
        if (!($exception instanceof RequestException)) {
            throw $exception;
        }

        $factory = new static();
        if ($factory->isNotFound($exception)) {
            $factory->throwNotFound($exception);
        }

        throw $exception;
    }

    /**
     * Check if given exception is a Not Found Exception.
     *
     * @param \GuzzleHttp\Exception\RequestException $exception
     *   The Exception to test.
     *
     * @return bool
     *   Is Not Found.
     */
    protected function isNotFound(RequestException $exception)
    {
        $codes = [404, 422];
        return in_array($exception->getCode(), $codes, true);
    }

    /**
     * Throw a not found Exception based on the error message in the body.
     *
     * @param \GuzzleHttp\Exception\RequestException $exception
     *   The Exception to create the NotFound from.
     *
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     */
    protected function throwNotFound(RequestException $exception)
    {
        $body = json_decode($exception->getResponse()->getBody()->getContents());

        if (!isset($body->error->target)) {
            throw NotFoundException::fromException($exception);
        }

        if ($body->error->target === 'Service') {
            throw ServiceNotFoundException::fromException($exception);
        }

        if ($body->error->target === 'Channel') {
            throw ChannelNotFoundException::fromException($exception);
        }

        throw NotFoundException::fromException($exception);
    }
}
