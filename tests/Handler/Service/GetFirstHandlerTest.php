<?php

declare(strict_types=1);

namespace StadGent\Services\Test\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Handler\Service\ExtractFirstHandler;
use StadGent\Services\OpeningHours\Request\Service\GetByOpenDataUriRequest;
use StadGent\Services\OpeningHours\Request\Service\GetBySourceIdRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * @covers \StadGent\Services\OpeningHours\Handler\Service\ExtractFirstHandler
 */
final class GetFirstHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles(): void
    {
        $handler = new ExtractFirstHandler();
        $this->assertEquals(
            [
                GetByOpenDataUriRequest::class,
                GetBySourceIdRequest::class,
            ],
            $handler->handles(),
            'Handles GetByOpenDataUriRequest & GetBySourceIdRequest.'
        );
    }

    /**
     * Test the toResponse method with returned data.
     */
    public function testToResponseWithData(): void
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
        }
    ]
EOT;
        $serviceResponse = $this->createResponseMock(200, $body);

        $handler = new ExtractFirstHandler();
        $response = $handler->toResponse($serviceResponse);

        $this->assertInstanceOf(
            ServiceResponse::class,
            $response,
            'Response should be a \StadGent\Services\OpeningHours\Response\ServiceResponse object.'
        );
    }
}
