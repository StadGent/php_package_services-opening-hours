<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Uri\Service;

use StadGent\Services\OpeningHours\Uri\BaseUri;

/**
 * Uri to get all Services by their (partial) label.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
final class SearchByLabelUri extends BaseUri
{
    /**
     * Construct the URI.
     *
     * @param string $label
     *   The (partial) Service label.
     */
    public function __construct(string $label)
    {
        $this->uri = sprintf('services?label=%s', $label);
    }
}
