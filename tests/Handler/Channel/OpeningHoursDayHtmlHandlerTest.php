<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursDayHtmlHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the OpeningHoursDayHtmlHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpeningHoursDayHtmlHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new OpeningHoursDayHtmlHandler();
        $this->assertEquals(
            [OpeningHoursDayHtmlRequest::class],
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest.'
        );
    }
}
