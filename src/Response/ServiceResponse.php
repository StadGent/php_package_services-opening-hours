<?php

namespace StadGent\Services\OpeningHours\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use StadGent\Services\OpeningHours\Value\Service;

/**
 * Response object containing a single service.
 *
 * @package StadGent\Services\OpeningHours\Response\Service
 */
class ServiceResponse implements ResponseInterface
{
    /**
     * The Service in the response.
     *
     * @var \StadGent\Services\OpeningHours\Value\Service
     */
    private $service;

    /**
     * GetAllResponse constructor.
     *
     * @param \StadGent\Services\OpeningHours\Value\Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get the Service.
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     */
    public function getService()
    {
        return $this->service;
    }
}
