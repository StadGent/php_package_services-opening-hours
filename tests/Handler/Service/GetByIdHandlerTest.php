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
        "createdAt": "2017-05-18 15:04:49",
        "updatedAt": "2017-11-17 12:01:13",
        "sourceIdentifier": "",
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
     * @expectedException \StadGent\Services\OpeningHours\Response\Exception\InvalidResponseException
     * @expectedExceptionMessage Response with status code 500 was unexpected.
     */
    public function testExceptionWhenResponseCodeIsNot200()
    {
        $serviceResponse = $this->createResponseMock(500, '{}');
        $handler = new GetByIdHandler();
        $handler->toResponse($serviceResponse);
    }

    /**
     * Test the NotFound Exception when response is 404.
     *
     * @expectedException \StadGent\Services\OpeningHours\Response\Exception\ServiceNotFoundException
     */
    public function testNotFoundExceptionWhenResponseCodeIs404()
    {
        $serviceResponse = $this->createResponseMock(404, '{}');
        $handler = new GetByIdHandler();
        $handler->toResponse($serviceResponse);
    }

    /**
     * Test the NotFound Exception when response is 422.
     *
     * @TODO: The 422 is temporary until the wrong return code from the API is
     *        fixed.
     *
     * @expectedException \StadGent\Services\OpeningHours\Response\Exception\ServiceNotFoundException
     */
    public function testNotFoundExceptionWhenResponseCodeIs422()
    {
        $serviceResponse = $this->createResponseMock(422, '{}');
        $handler = new GetByIdHandler();
        $handler->toResponse($serviceResponse);
    }
}
