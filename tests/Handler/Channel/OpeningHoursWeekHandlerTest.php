<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursWeekHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekRequest;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the OpeningHoursWeekHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpeningHoursWeekHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new OpeningHoursWeekHandler();
        $this->assertEquals(
            [OpeningHoursWeekRequest::class],
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekRequest.'
        );
    }
}
