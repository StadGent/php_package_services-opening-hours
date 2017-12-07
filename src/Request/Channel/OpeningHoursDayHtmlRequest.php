<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\AcceptType;

/**
 * Get the OpeningHours for a single day as HTML.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class OpeningHoursDayHtmlRequest extends OpeningHoursDayRequest
{
    /**
     * The accept header when creating the request.
     *
     * @var string
     */
    protected $headerAccept = AcceptType::HTML;
}
