<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursYearHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearRequest;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the OpeningHoursYearHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpeningHoursYearHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new OpeningHoursYearHandler();
        $this->assertEquals(
            OpeningHoursYearRequest::class,
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearRequest.'
        );
    }
}
