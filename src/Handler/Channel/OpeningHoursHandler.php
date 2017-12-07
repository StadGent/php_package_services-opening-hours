<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearRequest;

/**
 * Handler to extract the OpeningHours data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class OpeningHoursHandler extends OpeningHoursAbstractHandler
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return [
            OpeningHoursDayRequest::class,
            OpeningHoursWeekRequest::class,
            OpeningHoursMonthRequest::class,
            OpeningHoursYearRequest::class,
            OpeningHoursPeriodRequest::class,
        ];
    }
}
