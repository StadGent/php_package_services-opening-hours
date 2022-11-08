<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri\Service;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get a single service by its source & source id.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class GetBySourceIdUri extends BaseUri
{
    /**
     * Construct the URI.
     *
     * @param string $source
     *   The source name (eg. recreatex).
     * @param string $sourceId
     *   The source id (eg. ReCreateX UUID).
     */
    public function __construct(string $source, string $sourceId)
    {
        $this->uri = sprintf('services?source=%s&sourceId=%s', $source, $sourceId);
    }
}
