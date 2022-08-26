<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Service\Channel;

use DigipolisGent\API\Service\ServiceInterface;
use StadGent\Services\OpeningHours\Value\Channel;
use StadGent\Services\OpeningHours\Value\ChannelCollection;

/**
 * Service to access the get Channel(s).
 *
 * @package StadGent\Services\OpeningHours
 */
interface ChannelServiceInterface extends ServiceInterface
{
    /**
     * Get all Channels for the given Service ID.
     *
     * @param int $serviceId
     *   The ID of the Service to get all Channels for.
     *
     * @return \StadGent\Services\OpeningHours\Value\ChannelCollection
     *   The Channels linked to the Service.
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getAll(int $serviceId): ChannelCollection;

    /**
     * Get a single Channel by its Service & Channel ID.
     *
     * @param int $serviceId
     *   The Service ID.
     * @param int $channelId
     *   The Channel ID.
     *
     * @return \StadGent\Services\OpeningHours\Value\Channel
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \StadGent\Services\OpeningHours\Exception\NotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     * @throws \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function getById(int $serviceId, int $channelId): Channel;
}
