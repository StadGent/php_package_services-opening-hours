<?php

namespace StadGent\Services\OpeningHours\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use StadGent\Services\OpeningHours\Value\OpeningHours;

/**
 * Response object containing a single OpeningHours value object.
 *
 * @package StadGent\Services\OpeningHours\Response
 */
class OpeningHoursResponse implements ResponseInterface
{
    /**
     * The OpeningHours object in the response.
     *
     * @var \StadGent\Services\OpeningHours\Value\OpeningHours
     */
    private $openingHours;

    /**
     * OpeningHoursResponse constructor.
     *
     * @param \StadGent\Services\OpeningHours\Value\OpeningHours $openingHours
     */
    public function __construct(OpeningHours $openingHours)
    {
        $this->openingHours = $openingHours;
    }

    /**
     * Get the OpenNow value.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpeningHours
     */
    public function getOpeninghours()
    {
        return $this->openingHours;
    }
}
