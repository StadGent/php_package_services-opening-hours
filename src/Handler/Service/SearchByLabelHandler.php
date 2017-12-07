<?php

namespace StadGent\Services\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;

/**
 * Handler to search for Services.
 *
 * @package StadGent\Services\OpeningHours\Handler\Service
 */
class SearchByLabelHandler extends GetAllHandler
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return [
            SearchByLabelRequest::class,
        ];
    }
}
