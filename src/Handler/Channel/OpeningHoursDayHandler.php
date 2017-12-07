<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayRequest;

/**
 * Handler to extract the OpeningHours data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class OpeningHoursDayHandler extends OpeningHoursAbstractHandler
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return [
            OpeningHoursDayRequest::class,
        ];
    }
}
