<?php

namespace StadGent\Services\OpeningHours\Request\Service;

use StadGent\Services\OpeningHours\Request\RequestAbstract;
use StadGent\Services\OpeningHours\Uri\Service\GetAllUri;

/**
 * Request to get all Services.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
class GetAllRequest extends RequestAbstract
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
