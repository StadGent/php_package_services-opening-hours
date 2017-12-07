<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearRequest;

/**
 * Handler to extract the OpeningHours data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class OpeningHoursYearHandler extends OpeningHoursAbstractHandler
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return [
            OpeningHoursYearRequest::class,
        ];
    }
}
