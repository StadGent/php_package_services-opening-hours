<?php

namespace StadGent\Services\OpeningHours;

use StadGent\Services\OpeningHours\Client\ClientInterface;

/**
 * Interface ServiceInterface.
 *
 * @package StadGent\Services\OpeningHours\Client\ClientInterface
 */
interface ServiceInterface
{
    /**
     * ServiceInterface constructor.
     *
     * @param \StadGent\Services\OpeningHours\Client\ClientInterface $client
     */
    public function __construct(ClientInterface $client);
}
