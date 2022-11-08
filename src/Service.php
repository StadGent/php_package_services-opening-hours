<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours;

use DigipolisGent\API\Client\ClientInterface;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Handler\Service\GetAllHandler;
use StadGent\Services\OpeningHours\Handler\Service\ExtractFirstHandler;
use StadGent\Services\OpeningHours\Handler\Service\GetByIdHandler;
use StadGent\Services\OpeningHours\Service\Service\ServiceService;
use StadGent\Services\OpeningHours\Service\Service\ServiceServiceInterface;

/**
 * Factory to create the ServiceService.
 *
 * @package StadGent\Services\OpeningHours
 */
final class Service
{
    /**
     * Expects a Client object.
     *
     * Will add the package handlers and inject the client and optional cache
     * into the ServiceService.
     *
     * @param \DigipolisGent\API\Client\ClientInterface $client
     * @param \Psr\SimpleCache\CacheInterface|null $cache
     *
     * @return \StadGent\Services\OpeningHours\Service\Service\ServiceServiceInterface
     */
    public static function create(ClientInterface $client, ?CacheInterface $cache = null): ServiceServiceInterface
    {
        $client->addHandler(new GetAllHandler());
        $client->addHandler(new GetByIdHandler());
        $client->addHandler(new ExtractFirstHandler());

        $service = new ServiceService($client);
        if ($cache) {
            $service->setCacheService($cache);
        }

        return $service;
    }
}
