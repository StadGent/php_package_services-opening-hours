<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodRequest;

/**
 * Handler to extract the OpeningHours data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class OpeningHoursPeriodHandler extends OpeningHoursAbstractHandler
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return OpeningHoursPeriodRequest::class;
    }
}
