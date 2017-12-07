<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursPeriodHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodRequest;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the OpeningHoursPeriodHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpeningHoursPeriodHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new OpeningHoursPeriodHandler();
        $this->assertEquals(
            OpeningHoursPeriodRequest::class,
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodRequest.'
        );
    }
}
