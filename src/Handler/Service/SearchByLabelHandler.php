<?php

namespace StadGent\Services\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;
use StadGent\Services\OpeningHours\Response\ServicesResponse;
use StadGent\Services\OpeningHours\Value\ServiceCollection;
use Psr\Http\Message as Psr;

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
        return SearchByLabelRequest::class;
    }
}
