<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursYearHtmlHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearHtmlRequest;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the OpeningHoursYearHtmlHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpeningHoursYearHtmlHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new OpeningHoursYearHtmlHandler();
        $this->assertEquals(
            [OpeningHoursYearHtmlRequest::class],
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearHtmlRequest.'
        );
    }
}
