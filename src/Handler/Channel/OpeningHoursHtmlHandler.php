<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\HtmlHandlerAbstract;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearHtmlRequest;

/**
 * Handler to extract the OpeningHoursDay data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
final class OpeningHoursHtmlHandler extends HtmlHandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [
            OpeningHoursDayHtmlRequest::class,
            OpeningHoursWeekHtmlRequest::class,
            OpeningHoursMonthHtmlRequest::class,
            OpeningHoursYearHtmlRequest::class,
            OpeningHoursPeriodHtmlRequest::class,
        ];
    }
}
