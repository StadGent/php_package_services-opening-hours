<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Service\Service;

use DigipolisGent\API\Cache\CacheableInterface;
use DigipolisGent\API\Logger\LoggableInterface;
use DigipolisGent\API\Service\ServiceInterface;
use StadGent\Services\OpeningHours\Value\Service;
use StadGent\Services\OpeningHours\Value\ServiceCollection;

/**
 * Service to access the Service related API.
 *
 * @package StadGent\Services\OpeningHours
 */
interface ServiceServiceInterface extends ServiceInterface, LoggableInterface, CacheableInterface
{
    /**
     * Get all Services.
     *
     * @return \StadGent\Services\OpeningHours\Value\ServiceCollection
     *
     * @throws \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    public function getAll(): ServiceCollection;

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
     * @throws \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    public function searchByLabel(string $label): ServiceCollection;

    /**
     * Get a single Service by its ID.
     *
     * @param string|int $serviceId
     *   The Service ID.
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getById($serviceId): Service;

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
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getByOpenDataUri(string $openDataUri): Service;

    /**
     * Get a service by its Vesta ID.
     *
     * @param string $vestaId
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getByVestaId(string $vestaId): Service;

    /**
     * Get a single Service by its source name & source id.
     *
     * @param string $source
     *   The source name (eg. recreatex).
     * @param string $sourceId
     *   The source ID (eg. ReCreateX  record UUID).
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getBySourceId(string $source, string $sourceId): Service;
}
