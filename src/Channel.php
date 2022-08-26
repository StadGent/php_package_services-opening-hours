<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours;

use DigipolisGent\API\Client\ClientInterface;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Handler\Channel\GetAllHandler;
use StadGent\Services\OpeningHours\Handler\Channel\GetByIdHandler;
use StadGent\Services\OpeningHours\Service\Channel\ChannelService;
use StadGent\Services\OpeningHours\Service\Channel\ChannelServiceInterface;

/**
 * Factory to create the ChannelService.
 *
 * @package StadGent\Services\OpeningHours
 */
class Channel
{
    /**
     * Expects a Client object.
     *
     * Will add the package handlers and inject the client and optional cache
     * into the ServiceService.
     *
     * @param \DigipolisGent\API\Client\ClientInterface $client
     * @param \Psr\SimpleCache\CacheInterface $cache
     *
     * @return \StadGent\Services\OpeningHours\Service\Channel\ChannelServiceInterface
     */
    public static function create(ClientInterface $client, CacheInterface $cache = null): ChannelServiceInterface
    {
        $client->addHandler(new GetAllHandler());
        $client->addHandler(new GetByIdHandler());

        $service = new ChannelService($client);
        if ($cache) {
            $service->setCacheService($cache);
        }

        return $service;
    }
}
