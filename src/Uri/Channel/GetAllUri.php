<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri\Channel;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get all Channels for a given Service id.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class GetAllUri extends BaseUri
{
    /**
     * Construct the URI from the Service ID.
     *
     * @param int $serviceId
     *   The Service ID.
     */
    public function __construct(int $serviceId)
    {
        $this->uri = sprintf('services/%d/channels', $serviceId);
    }
}
