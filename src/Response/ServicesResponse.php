<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use StadGent\Services\OpeningHours\Value\ServiceCollection;

/**
 * Response object containing a collection of services.
 *
 * @package StadGent\Services\OpeningHours\Response
 */
final class ServicesResponse implements ResponseInterface
{
    /**
     * Collection containing the Services.
     *
     * @var \StadGent\Services\OpeningHours\Value\ServiceCollection
     */
    private ServiceCollection $services;

    /**
     * GetAllResponse constructor.
     *
     * @param \StadGent\Services\OpeningHours\Value\ServiceCollection $services
     */
    public function __construct(ServiceCollection $services)
    {
        $this->services = $services;
    }

    /**
     * Get the Services.
     *
     * @return \StadGent\Services\OpeningHours\Value\ServiceCollection
     */
    public function getServices(): ServiceCollection
    {
        return $this->services;
    }
}
