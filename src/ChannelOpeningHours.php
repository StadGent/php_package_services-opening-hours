<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours;

use DigipolisGent\API\Client\ClientInterface;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHandler;
use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursService;
use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursServiceInterface;

/**
 * Factory to create the ChannelOpeningHoursService.
 *
 * @package StadGent\Services\OpeningHours
 */
final class ChannelOpeningHours
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
     * @return \StadGent\Services\OpeningHours\Service\Channel\OpeningHoursServiceInterface
     */
    public static function create(ClientInterface $client, ?CacheInterface $cache = null): OpeningHoursServiceInterface
    {
        $client->addHandler(new OpenNowHandler());
        $client->addHandler(new OpeningHoursHandler());

        $service = new OpeningHoursService($client);
        if ($cache) {
            $service->setCacheService($cache);
        }

        return $service;
    }
}
