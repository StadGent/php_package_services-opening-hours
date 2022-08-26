<?php

namespace StadGent\Services\OpeningHours\Exception;

use Exception;
use GuzzleHttp\Exception\RequestException;

/**
 * Factory to create the proper exception based on the the client Exception.
 *
 * @package StadGent\Services\OpeningHours\Exception
 */
final class ExceptionFactory
{
    /**
     * Create a new Exception (if required) for the given Exception.
     *
     * This allows us to wrap API exceptions to our own.
     *
     * @param \Exception $exception
     *   The exception to check and optionally transform.
     *
     * @return \Exception
     */
    public static function fromException(\Exception $exception): Exception
    {
        if (!($exception instanceof RequestException)) {
            return $exception;
        }

        $factory = new static();
        if ($factory->isNotFound($exception)) {
            return $factory->throwNotFound($exception);
        }

        return $exception;
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
     * @return Exception
     */
    protected function throwNotFound(RequestException $exception): Exception
    {
        $body = json_decode($exception->getResponse()->getBody()->getContents());

        if (!isset($body->error->target)) {
            return NotFoundException::fromException($exception);
        }

        if ($body->error->target === 'Service') {
            return ServiceNotFoundException::fromException($exception);
        }

        if ($body->error->target === 'Channel') {
            return ChannelNotFoundException::fromException($exception);
        }

        return NotFoundException::fromException($exception);
    }
}
