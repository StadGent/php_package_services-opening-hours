<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\AcceptType;

/**
 * Request to get OpenNow for a Channel in HTML format.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class OpenNowHtmlRequest extends OpenNowRequest
{
    /**
     * The accept header when creating the request.
     *
     * @var string
     */
    protected $headerAccept = AcceptType::HTML;
}
