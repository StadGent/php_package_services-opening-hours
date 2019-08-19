<?php

namespace StadGent\Services\Test\OpeningHours\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\SimpleCache\CacheInterface;

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
     * @param \DigipolisGent\API\Client\Response\ResponseInterface|null $response
     * @param \Psr\Http\Message\RequestInterface $expectedRequest
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
     * @return \PHPUnit_Framework_MockObject_MockObject|\DigipolisGent\API\Client\ClientInterface
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
     * @return \PHPUnit_Framework_MockObject_MockObject|\DigipolisGent\API\Client\ClientInterface
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
     * @return \PHPUnit_Framework_MockObject_MockObject|\DigipolisGent\API\Client\ClientInterface
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

    /**
     * Use this mock to test loading a cached item by its key from the cache.
     *
     * @param string $key
     *   The cache key to get the cache from.
     * @param mixed $item
     *   The cached item.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\Psr\SimpleCache\CacheInterface
     */
    protected function getFromCacheMock($key, $item)
    {
        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo($key))
            ->will($this->returnValue($item));

        return $cache;
    }

    /**
     * Use this mock to test saving an item to the cache by its key.
     *
     * @param string $key
     *   The cache key to store the item to.
     * @param mixed $item
     *   The expected item to store in the cache.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\Psr\SimpleCache\CacheInterface
     */
    protected function getSetCacheMock($key, $item)
    {
        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo($key))
            ->will($this->returnValue(null));

        $cache
            ->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo($key),
                $this->equalTo($item)
            );

        return $cache;
    }
}
