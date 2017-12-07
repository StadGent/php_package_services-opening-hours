<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursHtmlHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekHtmlRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearHtmlRequest;
use StadGent\Services\OpeningHours\Response\HtmlResponse;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Tests the OpeningHoursHtmlHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpeningHoursHtmlHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $expectedHandles = [
            OpeningHoursDayHtmlRequest::class,
            OpeningHoursWeekHtmlRequest::class,
            OpeningHoursMonthHtmlRequest::class,
            OpeningHoursYearHtmlRequest::class,
            OpeningHoursPeriodHtmlRequest::class,
        ];

        $handler = new OpeningHoursHtmlHandler();
        $this->assertEquals(
            $expectedHandles,
            $handler->handles()
        );
    }

    /**
     * Test the toResponse method with returned data.
     */
    public function testToResponseWithData()
    {
        $body = <<<EOT
<div vocab="http://schema.org/" typeof="Library">
    <h1>FooBar</h1>
    <div>open</div>
</div>
EOT;
        $openNowResponse = $this->createResponseMock(200, $body);

        $handler = new OpeningHoursHtmlHandler();
        $response = $handler->toResponse($openNowResponse);

        $this->assertInstanceOf(
            HtmlResponse::class,
            $response,
            'Response should be a \StadGent\Services\OpeningHours\Response\HtmlResponse object.'
        );
    }
}
