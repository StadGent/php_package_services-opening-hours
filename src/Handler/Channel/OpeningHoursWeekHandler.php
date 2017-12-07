<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekRequest;

/**
 * Handler to extract the OpeningHours data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class OpeningHoursWeekHandler extends OpeningHoursAbstractHandler
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return [
            OpeningHoursWeekRequest::class,
        ];
    }
}
