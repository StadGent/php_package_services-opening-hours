<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri\Service;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get a single service by its open data URI.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class GetByOpenDataUriUri extends BaseUri
{
    /**
     * Construct the URI.
     *
     * @param string $openDataUri
     *   The Service open data URI.
     */
    public function __construct(string $openDataUri)
    {
        $this->uri = sprintf('services?uri=%s', $openDataUri);
    }
}
