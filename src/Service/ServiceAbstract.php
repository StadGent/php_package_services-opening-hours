<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Service;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\API\Service\ServiceAbstract as BaseServiceAbstract;
use Psr\Http\Message\RequestInterface;
use StadGent\Services\OpeningHours\Cache\CacheKeyTrait;
use StadGent\Services\OpeningHours\Exception\UnexpectedResponseException;

/**
 * Class ServiceAbstract.
 *
 * @package StadGent\Services\OpeningHours
 */
abstract class ServiceAbstract extends BaseServiceAbstract
{
    use CacheKeyTrait;

    /**
     * Send the request using the client and validate the response object.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     *   The request object to send trough the client.
     * @param string $expectedClass
     *   The expected response class.
     *
     * @return \DigipolisGent\API\Client\Response\ResponseInterface
     *
     * @throws \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    protected function send(RequestInterface $request, string $expectedClass): ResponseInterface
    {
        // Get from service.
        $response = $this->client()->send($request);

        if (!$response instanceof $expectedClass) {
            throw UnexpectedResponseException::fromClass(
                get_class($response),
                $expectedClass
            );
        }

        return $response;
    }
}
