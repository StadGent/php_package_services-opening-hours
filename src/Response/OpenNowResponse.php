<?php

namespace StadGent\Services\OpeningHours\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use StadGent\Services\OpeningHours\Value\OpenNow;

/**
 * Response object containing a single OpenNow object.
 *
 * @package StadGent\Services\OpeningHours\Response
 */
class OpenNowResponse implements ResponseInterface
{
    /**
     * The OpenNow object in the response.
     *
     * @var \StadGent\Services\OpeningHours\Value\OpenNow
     */
    private $openNow;

    /**
     * OpenNowResponse constructor.
     *
     * @param \StadGent\Services\OpeningHours\Value\OpenNow $openNow
     */
    public function __construct(OpenNow $openNow)
    {
        $this->openNow = $openNow;
    }

    /**
     * Get the OpenNow value.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpenNow
     */
    public function getOpenNow()
    {
        return $this->openNow;
    }
}
