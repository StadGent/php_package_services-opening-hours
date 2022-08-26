<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri\Service;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get a single service by its ID.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class GetByIdUri extends BaseUri
{
    /**
     * Construct the URI.
     *
     * @param int $serviceId
     *   The Service ID.
     */
    public function __construct(int $serviceId)
    {
        $this->uri = sprintf('services/%d', $serviceId);
    }
}
