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
     * @return \Exception
     */
    public static function fromException(\Exception $e)
    {
        if (!($e instanceof RequestException)) {
            return $e;
        }

        $factory = new static();
        if ($factory->isNotFound($e)) {
            return $factory->createNotFound($e);
        }

        return $e;
    }

    /**
     * Check if given exception is a Not Found Exception.
     *
     * @param \GuzzleHttp\Exception\RequestException $e
     *   The Exception to test.
     *
     * @return bool
     *   Is Not Found.
     */
    protected function isNotFound(RequestException $e)
    {
        $codes = [404, 422];
        return in_array($e->getCode(), $codes);
    }

    /**
     * Create a not found Exception.
     *
     * @param \GuzzleHttp\Exception\RequestException $e
     *   The Exception to create the NotFound from.
     *
     * @return \StadGent\Services\OpeningHours\Exception\ExceptionWithResponseInterface
     *   The proper NotFoundException.
     */
    protected function createNotFound(RequestException $e)
    {
        $body = json_decode($e->getResponse()->getBody()->getContents());

        if (!isset($body->error->target)) {
            return NotFoundException::fromException($e);
        }

        if ($body->error->target === 'Service') {
            return ServiceNotFoundException::fromException($e);
        }

        if ($body->error->target === 'Channel') {
            return ChannelNotFoundException::fromException($e);
        }

        return NotFoundException::fromException($e);
    }
}
