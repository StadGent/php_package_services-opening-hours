<?php

namespace StadGent\Services\Test\OpeningHours\Client;

use StadGent\Services\OpeningHours\Client\Client;
use StadGent\Services\OpeningHours\Configuration\ConfigurationInterface;
use StadGent\Services\OpeningHours\Handler\HandlerInterface;
use StadGent\Services\OpeningHours\Request\RequestInterface;
use GuzzleHttp\Client as GuzzleClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test the Client object.
 *
 * @package StadGent\Services\Test\OpeningHours\Client
 */
class ClientTest extends TestCase
{
    /**
     * Test the send method.
     */
    public function testSend()
    {
        $config = $this->getConfigMock();
        $request = $this->getRequestMock();
        $response = $this->getResponseMock();
        $guzzle = $this->getGuzzleClientMock($request, $response);
        $handler = $this->getHandlerMock($request, $response, 'Success');

        $client = new Client($guzzle, $config);
        $client->addHandler($handler);
        $this->assertEquals(
            'Success',
            $client->send($request)
        );
    }

    /**
     * Test Exception when no handler supports the request.
     *
     * @expectedException \StadGent\Services\OpeningHours\Handler\Exception\NoHandlerException
     * @expectedExceptionMessageRegExp /No handler found that supports request ".+"\./
     */
    public function testSendExceptionWhenNoHandlerSupportsRequest()
    {
        $config = $this->getConfigMock();
        $request = $this->getRequestMock();
        $response = $this->getResponseMock();
        $guzzle = $this->getGuzzleClientMock($request, $response);

        $client = new Client($guzzle, $config);
        $client->send($request);
    }

    /**
     * Helper to construct the request mock.
     *
     * NOTE: The request is cloned while adding the headers. This is why all the
     * different mock objects are necessary.
     *
     * Don't forget to add a new mock for each withHeader() call added to the
     * Client::injectHeaders() method.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|RequestInterface
     */
    protected function getRequestMock()
    {
        $request = $this
          ->getMockBuilder(RequestInterface::class)
          ->disableOriginalConstructor()
          ->getMock();

        return $request;
    }

    /**
     * Get the response mock.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|ResponseInterface
     */
    protected function getResponseMock()
    {
        $response = $this
          ->getMockBuilder(ResponseInterface::class)
          ->disableOriginalConstructor()
          ->getMock();

        return $response;
    }

    /**
     * Get the GuzzleClient mock.
     *
     * @param RequestInterface $request
     *   The request that will be send trough the GuzzleClient.
     * @param ResponseInterface $response
     *   The response mock that should be returned by the GuzzleClient.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|GuzzleClient
     */
    protected function getGuzzleClientMock(RequestInterface $request, ResponseInterface $response)
    {
        $guzzle = $this
          ->getMockBuilder(GuzzleClient::class)
          ->disableOriginalConstructor()
          ->getMock();
        $guzzle
          ->expects($this->once())
          ->method('send')
          ->with($this->equalTo($request))
          ->willReturn($response);

        return $guzzle;
    }

    /**
     * Get the Configuration mock.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|ConfigurationInterface
     */
    protected function getConfigMock()
    {
        $config = $this
          ->getMockBuilder(ConfigurationInterface::class)
          ->disableOriginalConstructor()
          ->getMock();

        return $config;
    }

    /**
     * Get the Handler mock.
     *
     * @param RequestInterface $request
     *   The request that the handler will handle.
     * @param ResponseInterface $response
     *   The response that handler will process.
     * @param mixed $value
     *   The value the Handler will return when its toResponse() method is
     *   called.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|HandlerInterface
     */
    protected function getHandlerMock(RequestInterface $request, ResponseInterface $response, $value)
    {
        $handler = $this
          ->getMockBuilder(HandlerInterface::class)
          ->disableOriginalConstructor()
          ->getMock();
        $handler
          ->expects($this->once())
          ->method('handles')
          ->will($this->returnValue([get_class($request)]));
        $handler
          ->expects($this->once())
          ->method('toResponse')
          ->with($this->equalTo($response))
          ->willReturn($value);

        return $handler;
    }
}
