<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Service\Service;

use StadGent\Services\OpeningHours\Service\ServiceAbstract;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Request\Service\GetAllRequest;
use StadGent\Services\OpeningHours\Request\Service\GetByIdRequest;
use StadGent\Services\OpeningHours\Request\Service\GetByOpenDataUriRequest;
use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\Response\ServicesResponse;
use StadGent\Services\OpeningHours\Value\Service;
use StadGent\Services\OpeningHours\Value\ServiceCollection;

/**
 * Service to access the Service related API.
 *
 * @package StadGent\Services\OpeningHours
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
final class ServiceService extends ServiceAbstract implements ServiceServiceInterface
{
    /**
     * @inheritDoc
     */
    public function getAll(): ServiceCollection
    {
        $cacheKey = $this->createCacheKeyFromArray(['all']);

        // From cache?
        $cached = $this->cacheGet($cacheKey);
        if ($cached) {
            return $cached;
        }

        // Get from service.
        /** @var \StadGent\Services\OpeningHours\Response\ServicesResponse $response */
        $response = $this->send(
            new GetAllRequest(),
            ServicesResponse::class
        );

        $services = $response->getServices();
        $this->cacheSet($cacheKey, $services);
        return $services;
    }

    /**
     * @inheritDoc
     */
    public function searchByLabel(string $label): ServiceCollection
    {
        /** @var \StadGent\Services\OpeningHours\Response\ServicesResponse $response */
        $response = $this->send(
            new SearchByLabelRequest($label),
            ServicesResponse::class
        );

        return $response->getServices();
    }

    /**
     * @inheritDoc
     */
    public function getById(string $serviceId): Service
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
            throw ExceptionFactory::fromException($e);
        }

        /** @var \StadGent\Services\OpeningHours\Response\ServiceResponse $response */
        $service = $response->getService();
        $this->cacheSet($cacheKey, $service);

        return $service;
    }

    /**
     * @inheritDoc
     */
    public function getByOpenDataUri(string $openDataUri): Service
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
            throw ExceptionFactory::fromException($e);
        }

        /** @var \StadGent\Services\OpeningHours\Response\ServiceResponse $response */
        $service = $response->getService();
        $this->cacheSet($cacheKey, $service);

        return $service;
    }

    /**
     * @inheritDoc
     */
    public function getByVestaId(string $vestaId): Service
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
    protected function createCacheKeyFromArray(array $parts): string
    {
        $key = 'service:value:' . implode(':', $parts);
        return $this->createCacheKey($key);
    }
}
