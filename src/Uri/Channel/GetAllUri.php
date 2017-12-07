<?php

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\Uri;

/**
 * Uri to get all Channels for a given Service id.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class GetAllUri extends Uri
{
    /**
     * Construct the URI from the Service ID.
     *
     * @param int $serviceId
     *   The Service ID.
     */
    public function __construct($serviceId)
    {
        $uri = sprintf('services/%d/channels', (int) $serviceId);
        parent::__construct($uri);
    }
}
