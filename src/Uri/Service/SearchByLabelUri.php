<?php

namespace StadGent\Services\OpeningHours\Uri\Service;

use DigipolisGent\API\Client\Uri\Uri;

/**
 * Uri to get all Services by their (partial) label.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class SearchByLabelUri extends Uri
{
    /**
     * Construct the URI.
     *
     * @param string $label
     *   The (partial) Service label.
     */
    public function __construct($label)
    {
        $uri = sprintf('services?label=%s', $label);
        parent::__construct($uri);
    }
}
