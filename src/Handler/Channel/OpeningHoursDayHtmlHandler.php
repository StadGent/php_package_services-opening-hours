<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\HtmlHandlerAbstract;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest;

/**
 * Handler to extract the OpeningHoursDay data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class OpeningHoursDayHtmlHandler extends HtmlHandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return [
            OpeningHoursDayHtmlRequest::class,
        ];
    }
}
