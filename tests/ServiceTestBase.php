<?php

namespace StadGent\Services\Test\OpeningHours;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Client\ClientInterface;
use StadGent\Services\OpeningHours\Request\RequestInterface;
use StadGent\Services\OpeningHours\Response\ResponseInterface;

/**
 * Base test class to test the Service classes.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ServiceTestBase extends TestCase
{
    /**
     * Helper to create a Client mock with given response.
     *
     * @param \StadGent\Services\OpeningHours\Response\ResponseInterface|null $response
     * @param \StadGent\Services\OpeningHours\Request\RequestInterface $expectedRequest
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|ClientInterface
     */
    protected function getClientMock(ResponseInterface $response, $expectedRequest = null)
    {
        $client = $this
          ->getMockBuilder(ClientInterface::class)
          ->disableOriginalConstructor()
          ->getMock();

        if ($expectedRequest) {
            $client
              ->expects($this->any())
              ->method('send')
              ->with($this->isInstanceOf($expectedRequest))
              ->will($this->returnValue($response));
        } else {
            $client
              ->expects($this->any())
              ->method('send')
              ->will($this->returnValue($response));
        }

        return $client;
    }

    /**
     * Helper to get a generic response mock.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|ResponseInterface
     */
    protected function getResponseDummyMock()
    {
        return $this
          ->getMockBuilder(ResponseInterface::class)
          ->disableOriginalConstructor()
          ->getMock();
    }

    /**
     * Helper to create a mocked client that will return a given exception.
     *
     * @param \Exception $exception
     *   The exception to be returned by the client.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function getClientWithExceptionMock(\Exception $exception)
    {
        $client = $this
            ->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $client
            ->expects($this->once())
            ->method('send')
            ->will($this->throwException($exception));

        return $client;
    }

    /**
     * Helper to create a mocked client throwing a ServiceNotFound exception.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function getClientWithServiceNotFoundExceptionMock()
    {
        $responseBody = <<<EOT
{
    "error": {
        "code": "ModelNotFoundException",
        "message": "Service model is not found with given identifier",
        "target": "Service"
    }
}
EOT;

        $exceptionMock = $this->getExceptionMock(404, $responseBody);
        return $this->getClientWithExceptionMock($exceptionMock);
    }

    /**
     * Helper to create a mocked client throwing a ChannelNotFound exception.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function getClientWithChannelNotFoundExceptionMock()
    {
        $responseBody = <<<EOT
{
    "error": {
        "code": "ModelNotFoundException",
        "message": "Channel model is not found with given identifier",
        "target": "Channel"
    }
}
EOT;

        $exceptionMock = $this->getExceptionMock(404, $responseBody);
        return $this->getClientWithExceptionMock($exceptionMock);
    }

    /**
     * Create an exception mock with response object.
     *
     * @param int $code
     *   The error code.
     * @param string $responseBody
     *   The response content.
     *
     * @return \GuzzleHttp\Exception\RequestException
     *   The exception.
     */
    protected function getExceptionMock($code, $responseBody)
    {
        $streamMock = $this
            ->getMockBuilder(Stream::class)
            ->disableOriginalConstructor()
            ->getMock();
        $streamMock
            ->expects($this->once())
            ->method('getContents')
            ->will($this->returnValue($responseBody));

        $requestMock = $this
            ->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $responseMock = $this
            ->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();
        $responseMock
            ->expects($this->once())
            ->method('getStatusCode')
            ->will($this->returnValue($code));
        $responseMock
            ->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($streamMock));

        return new RequestException(
            'FooBar',
            $requestMock,
            $responseMock
        );
    }
}
