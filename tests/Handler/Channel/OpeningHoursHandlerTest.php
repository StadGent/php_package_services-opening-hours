<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearRequest;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the OpenNowHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpeningHoursHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $expectedHandles = [
            OpeningHoursDayRequest::class,
            OpeningHoursWeekRequest::class,
            OpeningHoursMonthRequest::class,
            OpeningHoursYearRequest::class,
            OpeningHoursPeriodRequest::class,
        ];

        $handler = new OpeningHoursHandler();
        $this->assertEquals(
            $expectedHandles,
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayRequest.'
        );
    }

    /**
     * Test the toResponse method with returned data.
     */
    public function testToResponseWithData()
    {
        $body = <<<EOT
{
    "channel": "FooBar",
    "channelId": 57,
    "openinghours": [
        {
            "date": "2017-12-12",
            "open": true,
            "hours": [
                {
                    "from": "09:00",
                    "until": "12:00"
                }
            ]
        }
    ]
}
EOT;
        $openingHoursResponse = $this->createResponseMock(200, $body);

        $handler = new OpeningHoursHandler();
        $response = $handler->toResponse($openingHoursResponse);

        $this->assertInstanceOf(
            OpeningHoursResponse::class,
            $response,
            'Response should be a \StadGent\Services\OpeningHours\Response\OpenNowResponse object.'
        );
    }
}
