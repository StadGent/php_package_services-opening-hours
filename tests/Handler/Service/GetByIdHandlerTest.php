<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Handler\Service\GetByIdHandler;
use StadGent\Services\OpeningHours\Handler\Service\SearchByLabelHandler;
use StadGent\Services\OpeningHours\Request\Service\GetByIdRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Test the GetByIdHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class GetByIdHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new GetByIdHandler();
        $this->assertEquals(
            GetByIdRequest::class,
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Service\GetByIdRequest.'
        );
    }

    /**
     * Test the toResponse method with returned data.
     */
    public function testToResponseWithData()
    {
        $body = <<<EOT
    {
        "id": 1,
        "uri": "http://dev.foo/FizzBuzz",
        "label": "Fizz Buzz",
        "description": "Fizz Buzz description",
        "created_at": "2017-05-18 15:04:49",
        "updated_at": "2017-11-17 12:01:13",
        "identifier": "",
        "source": null,
        "draft": 0,
        "countChannels": 1
    }
EOT;
        $serviceResponse = $this->createResponseMock(200, $body);

        $handler = new GetByIdHandler();
        $response = $handler->toResponse($serviceResponse);

        $this->assertInstanceOf(
          ServiceResponse::class,
          $response,
          'Response should be a \StadGent\Services\OpeningHours\Response\ServiceResponse object.'
        );
    }

    /**
     * Test the Exception when no data is returned.
     *
     * @expectedException \StadGent\Services\OpeningHours\Client\Exception\InvalidResponse
     * @expectedExceptionMessage Response with status code 500 was unexpected : "{}".
     */
    public function testExceptionWhenResponseCodeIsNot200()
    {
        $serviceResponse = $this->createResponseMock(500, '{}');
        $handler = new GetByIdHandler();
        $handler->toResponse($serviceResponse);
    }
}
