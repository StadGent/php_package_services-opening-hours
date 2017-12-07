<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowRequest;
use StadGent\Services\OpeningHours\Response\OpenNowResponse;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the OpenNowHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpenNowHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new OpenNowHandler();
        $this->assertEquals(
            OpenNowRequest::class,
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\OpenNowRequest.'
        );
    }

    /**
     * Test the toResponse method with returned data.
     */
    public function testToResponseWithData()
    {
        $body = <<<EOT
{
    "channel": "Loketten",
    "channelId": 57,
    "openNow": {
        "label": "open",
        "status": true
    }
}
EOT;
        $openNowResponse = $this->createResponseMock(200, $body);

        $handler = new OpenNowHandler();
        $response = $handler->toResponse($openNowResponse);

        $this->assertInstanceOf(
            OpenNowResponse::class,
            $response,
            'Response should be a \StadGent\Services\OpeningHours\Response\OpenNowResponse object.'
        );
    }
}
