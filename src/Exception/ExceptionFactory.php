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
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     */
    public static function fromException(\Exception $e)
    {
        if (!($e instanceof RequestException)) {
            throw $e;
        }

        $factory = new static();
        if ($factory->isNotFound($e)) {
            $factory->throwNotFound($e);
        }

        throw $e;
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
     * Throw a not found Exception based on the error message in the body.
     *
     * @param \GuzzleHttp\Exception\RequestException $e
     *   The Exception to create the NotFound from.
     *
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     */
    protected function throwNotFound(RequestException $e)
    {
        $body = json_decode($e->getResponse()->getBody()->getContents());

        if (!isset($body->error->target)) {
            throw NotFoundException::fromException($e);
        }

        if ($body->error->target === 'Service') {
            throw ServiceNotFoundException::fromException($e);
        }

        if ($body->error->target === 'Channel') {
            throw ChannelNotFoundException::fromException($e);
        }

        throw NotFoundException::fromException($e);
    }
}
