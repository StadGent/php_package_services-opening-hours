<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursPeriodHtmlHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodHtmlRequest;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the OpeningHoursPeriodHtmlHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpeningHoursPeriodHtmlHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new OpeningHoursPeriodHtmlHandler();
        $this->assertEquals(
            [OpeningHoursPeriodHtmlRequest::class],
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodHtmlRequest.'
        );
    }
}
