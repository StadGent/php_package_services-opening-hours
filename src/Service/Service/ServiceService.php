<?php

namespace StadGent\Services\OpeningHours\Service\Service;

use StadGent\Services\OpeningHours\Service\ServiceAbstract;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Request\Service\GetAllRequest;
use StadGent\Services\OpeningHours\Request\Service\GetByIdRequest;
use StadGent\Services\OpeningHours\Request\Service\GetByOpenDataUriRequest;
use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\Response\ServicesResponse;

/**
 * Service to access the Service related API.
 *
 * @package StadGent\Services\OpeningHours
 */
class ServiceService extends ServiceAbstract
{
    /**
     * Get all Services.
     *
     * @return \StadGent\Services\OpeningHours\Value\ServiceCollection
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    public function getAll()
    {
        $cacheKey = $this->createCacheKeyFromArray(['all']);

        // From cache?
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        // Get from service.
        /* @var $response \StadGent\Services\OpeningHours\Response\ServicesResponse */
        $response = $this->send(
            new GetAllRequest(),
            ServicesResponse::class
        );

        $services = $response->getServices();
        $this->cacheSet($cacheKey, $services);
        return $services;
    }

    /**
     * Find services by their (partial) label.
     *
     * NOTE: The search results are never cached.
     *
     * @param string $label
     *   The (partial) label to search by.
     *
     * @return \StadGent\Services\OpeningHours\Value\ServiceCollection
     *   Collection of found Services (if any).
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    public function searchByLabel($label)
    {
        /* @var $response \StadGent\Services\OpeningHours\Response\ServicesResponse */
        $response = $this->send(
            new SearchByLabelRequest($label),
            ServicesResponse::class
        );

        return $response->getServices();
    }

    /**
     * Get a single Service by its ID.
     *
     * @param string $serviceId
     *   The Service ID.
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getById($serviceId)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['id', $serviceId]
        );

        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            // Get from service.
            $response = $this->send(
                new GetByIdRequest($serviceId),
                ServiceResponse::class
            );
        } catch (\Exception $e) {
            ExceptionFactory::fromException($e);
        }

        /* @var $response \StadGent\Services\OpeningHours\Response\ServiceResponse */
        $service = $response->getService();
        $this->cacheSet($cacheKey, $service);

        return $service;
    }

    /**
     * Get a single Service by its open data uri.
     *
     * @param string $openDataUri
     *   The Service open data uri.
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getByOpenDataUri($openDataUri)
    {
        $cacheKey = $this->createCacheKeyFromArray(
            ['uri', $openDataUri]
        );

        // By default from cache.
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            // Get from service.
            $response = $this->send(
                new GetByOpenDataUriRequest($openDataUri),
                ServiceResponse::class
            );
        } catch (\Exception $e) {
            ExceptionFactory::fromException($e);
        }

        /* @var $response \StadGent\Services\OpeningHours\Response\ServiceResponse */
        $service = $response->getService();
        $this->cacheSet($cacheKey, $service);

        return $service;
    }

    /**
     * Get a service by its Vesta Id.
     *
     * @param string $vestaId
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getByVestaId($vestaId)
    {
        $uri = sprintf('https://stad.gent/id/agents/%s', $vestaId);
        return $this->getByOpenDataUri($uri);
    }

    /**
     * Helper to create a cache key.
     *
     * @param array $parts
     *   The cache key parts, will be added to the key separated by ":".
     *
     * @return string
     *   Prefixed cache key.
     */
    protected function createCacheKeyFromArray(array $parts)
    {
        $key = 'service:value:' . implode(':', $parts);
        return $this->createCacheKey($key);
    }
}
