<?php

namespace StadGent\Services\OpeningHours;

use StadGent\Services\OpeningHours\Cache\CacheableInterface;
use StadGent\Services\OpeningHours\Cache\CacheableTrait;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Request\Service\GetAllRequest;
use StadGent\Services\OpeningHours\Request\Service\GetByIdRequest;
use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\Response\ServicesResponse;

/**
 * Service to access the Service related API.
 *
 * @package StadGent\Services\OpeningHours
 */
class ServiceService extends ServiceAbstract implements CacheableInterface
{
    use CacheableTrait;

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
        $cacheKey = $this->createCacheKey(__FUNCTION__);

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
        $cacheKey = $this->createCacheKey(__FUNCTION__ . ':' . $serviceId);

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
}
