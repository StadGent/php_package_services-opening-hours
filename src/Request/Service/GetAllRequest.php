<?php

namespace StadGent\Services\OpeningHours\Request\Service;

use DigipolisGent\API\Client\Request\AbstractRequest;
use StadGent\Services\OpeningHours\Uri\Service\GetAllUri;

/**
 * Request to get all Services.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
class GetAllRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $uri = new GetAllUri();
        parent::__construct($uri);
    }
}
