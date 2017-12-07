<?php

namespace StadGent\Services\OpeningHours\Request\Service;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\MethodType;
use StadGent\Services\OpeningHours\Request\RequestAbstract;

/**
 * Request to Search services by (partial) label.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
class SearchByLabelRequest extends RequestAbstract
{
    /**
     * Request to search services by the (partial) label.
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
