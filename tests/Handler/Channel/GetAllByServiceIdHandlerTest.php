<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\GetAllByServiceIdHandler;
use StadGent\Services\OpeningHours\Request\Channel\GetAllByServiceIdRequest;
use StadGent\Services\OpeningHours\Response\ChannelsResponse;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the GetAllByServiceIdHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class GetAllByServiceIdHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new GetAllByServiceIdHandler();
        $this->assertEquals(
            GetAllByServiceIdRequest::class,
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\GetAllByServiceIdRequest.'
        );
    }

    /**
     * Test the toResponse method with returned data.
     */
    public function testToResponseWithData()
    {
        $body = <<<EOT
[
    {
        "id": 65,
        "label": "Fizz Buzz",
        "serviceId": 1,
        "createdAt": "2017-05-18 15:04:49",
        "updatedAt": "2017-11-17 12:01:13"
    },
    {
        "id": 98,
        "label": "Foo Bar",
        "serviceId": 1,
        "createdAt": "2017-05-18 15:04:49",
        "updatedAt": "2017-11-17 14:49:18"
    }
]
EOT;
        $channelsResponse = $this->createResponseMock(200, $body);

        $handler = new GetAllByServiceIdHandler();
        $response = $handler->toResponse($channelsResponse);

        $this->assertInstanceOf(
            ChannelsResponse::class,
            $response,
            'Response should be a \StadGent\Services\OpeningHours\Response\Service\ChannelsResponse object.'
        );
    }
}
