<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours;

use DigipolisGent\API\Client\ClientInterface;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHtmlHandler;
use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursHtmlService;
use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursHtmlServiceInterface;

/**
 * Factory to create the ChannelOpeningHoursHtmlService.
 *
 * @package StadGent\Services\OpeningHours
 */
class ChannelOpeningHoursHtml
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
     * @return \StadGent\Services\OpeningHours\Service\Channel\OpeningHoursHtmlServiceInterface
     */
    public static function create(ClientInterface $client, CacheInterface $cache = null): OpeningHoursHtmlServiceInterface
    {
        $client->addHandler(new OpenNowHtmlHandler());
        $client->addHandler(new OpeningHoursHtmlHandler());

        $service = new OpeningHoursHtmlService($client);
        if ($cache) {
            $service->setCacheService($cache);
        }

        return $service;
    }
}
