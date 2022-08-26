<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Handler\Service\GetAllHandler;
use StadGent\Services\OpeningHours\Request\Service\GetAllRequest;
use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;
use StadGent\Services\OpeningHours\Response\ServicesResponse;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the GetAllHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class GetAllHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new GetAllHandler();
        $this->assertEquals(
            [GetAllRequest::class, SearchByLabelRequest::class],
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Service\GetAllRequest.'
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
        "id": 1,
        "uri": "http://dev.foo/FizzBuzz",
        "label": "Fizz Buzz",
        "description": "Fizz Buzz description",
        "createdAt": "2017-05-18 15:04:49",
        "updatedAt": "2017-11-17 12:01:13",
        "sourceIdentifier": "",
        "source": null,
        "draft": 0,
        "countChannels": 1
    },
    {
        "id": 2,
        "uri": "http://dev.foo/FooBar",
        "label": "Foo Bar",
        "description": "Foo Bar description",
        "createdAt": "2017-05-18 15:04:49",
        "updatedAt": "2017-11-17 14:49:18",
        "sourceIdentifier": "",
        "source": null,
        "draft": 0,
        "countChannels": 2
    }
]
EOT;
        $serviceResponse = $this->createResponseMock(200, $body);

        $handler = new GetAllHandler();
        $response = $handler->toResponse($serviceResponse);

        $this->assertInstanceOf(
            ServicesResponse::class,
            $response,
            'Response should be a \StadGent\Services\OpeningHours\Response\Service\ServicesResponse object.'
        );
    }
}
