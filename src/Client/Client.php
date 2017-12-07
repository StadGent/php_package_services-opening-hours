<?php

namespace StadGent\Services\OpeningHours\Client;

use StadGent\Services\OpeningHours\Client\Configuration\ConfigurationInterface;
use StadGent\Services\OpeningHours\Handler\HandlerInterface;
use StadGent\Services\OpeningHours\Handler\Exception\NoHandlerException;
use StadGent\Services\OpeningHours\Request\RequestInterface;

/**
 * The client to connect to the API.
 *
 * @package StadGent\Services\OpeningHours\Client
 */
class Client implements ClientInterface
{
    /**
     * @var \StadGent\Services\OpeningHours\Handler\HandlerInterface[]
     */
    private $handlers = [];

    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzle;

    /**
     * @var \StadGent\Services\OpeningHours\Client\Configuration\ConfigurationInterface
     */
    protected $configuration;

    /**
     * Client constructor.
     *
     * @param \GuzzleHttp\Client $guzzle
     *   The HTTP client.
     * @param \StadGent\Services\OpeningHours\Client\Configuration\ConfigurationInterface $configuration
     *   The configuration.
     */
    public function __construct(\GuzzleHttp\Client $guzzle, ConfigurationInterface $configuration)
    {
        $this->guzzle = $guzzle;
        $this->configuration = $configuration;
    }

    /**
     * @inheritdoc
     *
     * @throws \StadGent\Services\OpeningHours\Handler\Exception\NoHandlerException
     */
    public function send(RequestInterface $request)
    {
        $psrResponse = $this->guzzle->send($request);
        $handler = $this->getHandler($request);
        return $handler->toResponse($psrResponse);
    }

    /**
     * Returns the correct handler for the given Request object.
     *
     * @param \StadGent\Services\OpeningHours\Request\RequestInterface $request
     *   The request to get the handler for.
     * @return \StadGent\Services\OpeningHours\Handler\HandlerInterface
     *   The supporting handler.
     *
     * @throws \StadGent\Services\OpeningHours\Handler\Exception\NoHandlerException
     *   If no handler is found for the given request.
     */
    protected function getHandler(RequestInterface $request)
    {
        $className = get_class($request);

        if (!array_key_exists($className, $this->handlers)) {
            throw NoHandlerException::fromClassName($className);
        }

        return $this->handlers[$className];
    }

    /**
     * @inheritdoc
     */
    public function addHandler(HandlerInterface $handler)
    {
        foreach ($handler->handles() as $requestType) {
            $this->handlers[$requestType] = $handler;
        }

        return $this;
    }
}
