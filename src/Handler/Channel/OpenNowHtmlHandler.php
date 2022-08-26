<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\HtmlHandlerAbstract;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowHtmlRequest;

/**
 * Handler to extract the OpenNow data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
final class OpenNowHtmlHandler extends HtmlHandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [
            OpenNowHtmlRequest::class,
        ];
    }
}
