<?php

namespace StadGent\Services\OpeningHours;

use StadGent\Services\OpeningHours\Client\ClientInterface;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Handler\Service\GetAllHandler;
use StadGent\Services\OpeningHours\Handler\Service\GetByIdHandler;
use StadGent\Services\OpeningHours\Handler\Service\SearchByLabelHandler;

/**
 * Factory to create the ServiceService.
 *
 * @package StadGent\Services\OpeningHours
 */
class ServiceServiceFactory
{
    /**
     * Expects a Client object.
     *
     * Will add the package handlers and inject the client and optional cache
     * into the ServiceService.
     *
     * @param ClientInterface $client
     * @param CacheInterface $cache
     *
     * @return ServiceService
     */
    public static function create(ClientInterface $client, CacheInterface $cache = null)
    {
        $client
            ->addHandler(new GetAllHandler())
            ->addHandler(new GetByIdHandler())
            ->addHandler(new SearchByLabelHandler())
        ;

        $service = new ServiceService($client);
        if ($cache) {
            $service->setCacheService($cache);
        }

        return $service;
    }
}
