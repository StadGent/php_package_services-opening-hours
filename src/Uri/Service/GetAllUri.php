<?php

namespace StadGent\Services\OpeningHours\Uri\Service;

use StadGent\Services\OpeningHours\Uri\Uri;

/**
 * Uri to get all Services.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class GetAllUri extends Uri
{
    /**
     * Construct the URI.
     */
    public function __construct()
    {
        parent::__construct('services');
    }
}
