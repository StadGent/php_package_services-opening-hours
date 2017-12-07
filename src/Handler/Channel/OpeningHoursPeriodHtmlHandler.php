<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\HtmlHandlerAbstract;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodHtmlRequest;

/**
 * Handler to extract the OpeningHoursDay data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class OpeningHoursPeriodHtmlHandler extends HtmlHandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return [
            OpeningHoursPeriodHtmlRequest::class,
        ];
    }
}
