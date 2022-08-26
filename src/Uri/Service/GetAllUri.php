<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri\Service;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get all Services.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class GetAllUri extends BaseUri
{
    /**
     * Construct the URI.
     */
    public function __construct()
    {
        $this->uri = 'services';
    }
}
