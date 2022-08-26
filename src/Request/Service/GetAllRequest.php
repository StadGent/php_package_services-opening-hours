<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Request\Service;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use StadGent\Services\OpeningHours\Uri\Service\GetAllUri;

/**
 * Request to get all Services.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
final class GetAllRequest extends AbstractJsonRequest
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
