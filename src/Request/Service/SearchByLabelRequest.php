<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Request\Service;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use StadGent\Services\OpeningHours\Uri\Service\SearchByLabelUri;

/**
 * Request to Search services by (partial) label.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
final class SearchByLabelRequest extends AbstractJsonRequest
{
    /**
     * Request to search services by the (partial) label.
     *
     * @param string $label
     *   The (partial) Service label.
     */
    public function __construct(string $label)
    {
        $uri = new SearchByLabelUri($label);
        parent::__construct($uri);
    }
}
