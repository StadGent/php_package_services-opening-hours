<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\GetByServiceAndChannelIdHandler;
use StadGent\Services\OpeningHours\Request\Channel\GetByServiceAndChannelIdRequest;
use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the GetByIdHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class GetByServiceAndChannelIdHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new GetByServiceAndChannelIdHandler();
        $this->assertEquals(
            GetByServiceAndChannelIdRequest::class,
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\GetByServiceAndChannelIdRequest.'
        );
    }

    /**
     * Test the toResponse method with returned data.
     */
    public function testToResponseWithData()
    {
        $body = <<<EOT
    {
        "id": 78,
        "label": "Fizz Buzz",
        "serviceId": 1,
        "createdAt": "2017-05-18 15:04:49",
        "updatedAt": "2017-11-17 12:01:13"
    }
EOT;
        $channelResponse = $this->createResponseMock(200, $body);

        $handler = new GetByServiceAndChannelIdHandler();
        $response = $handler->toResponse($channelResponse);

        $this->assertInstanceOf(
            ChannelResponse::class,
            $response,
            'Response should be a \StadGent\Services\OpeningHours\Response\ChannelResponse object.'
        );
    }
}
