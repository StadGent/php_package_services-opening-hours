<?php

namespace StadGent\Services\Test\OpeningHours\Client;

use DigipolisGent\API\Client\Exception\HandlerNotFound;
use DigipolisGent\API\Client\Response\ResponseInterface as ServiceResponseInterface;
use GuzzleHttp\Client as GuzzleClient;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use StadGent\Services\OpeningHours\Client\Client;
use StadGent\Services\OpeningHours\Configuration\ConfigurationInterface;
use DigipolisGent\API\Client\Handler\HandlerInterface;

/**
 * Test the Client object.
 *
 * @package StadGent\Services\Test\OpeningHours\Client
 */
class ClientTest extends TestCase
{
    /**
     * API Key is send as header.
     */
    public function apiKeyIsSendAsHeader()
    {
        $key = 'fiz-baz-key';
        $config = $this->getConfigMock($key);
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
     * Test the send method.
     */
    public function testSend()
    {
        $key = 'fiz-baz-key';
        $config = $this->getConfigMock($key);
        $request = $this->getRequestMock();
        $request->expects($this->any())
            ->method('withHeader')
            ->willReturnSelf();
        $response = $this->getResponseMock();

        $serviceResponse = $this->createMock(ServiceResponseInterface::class);

        $guzzle = $this->getGuzzleClientMock($request, $response);
        $handler = $this->getHandlerMock($request, $response, $serviceResponse);

        $client = new Client($guzzle, $config);
        $client->addHandler($handler);
        $this->assertEquals(
            $serviceResponse,
            $client->send($request)
        );
    }

    /**
     * Test Exception when no handler supports the request.
     */
    public function testSendExceptionWhenNoHandlerSupportsRequest()
    {
        $this->expectException(HandlerNotFound::class);
        $this->expectExceptionMessageMatches('/No handler was registered for .+/');
        $key = 'fiz-baz-key';
        $config = $this->getConfigMock($key);
        $request = $this->getRequestMock();
        $request->expects($this->any())
            ->method('withHeader')
            ->willReturnSelf();
        $guzzle = $this->createMock(GuzzleClient::class);
        $guzzle
            ->expects($this->never())
            ->method('send');

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
     * @return MockObject|RequestInterface
     */
    protected function getRequestMock()
    {
        return $this->createMock(RequestInterface::class);
    }

    /**
     * Get the response mock.
     *
     * @return MockObject|ResponseInterface
     */
    protected function getResponseMock()
    {
        return $this->createMock(ResponseInterface::class);
    }

    /**
     * Get the GuzzleClient mock.
     *
     * @param RequestInterface $request
     *   The request that will be send trough the GuzzleClient.
     * @param ResponseInterface $response
     *   The response mock that should be returned by the GuzzleClient.
     *
     * @return MockObject|GuzzleClient
     */
    protected function getGuzzleClientMock(RequestInterface $request, ResponseInterface $response)
    {
        $guzzle = $this->createMock(GuzzleClient::class);
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
     * @param $key
     *   The api key.
     *
     * @return MockObject|ConfigurationInterface
     */
    protected function getConfigMock($key)
    {
        $config = $this->createMock(ConfigurationInterface::class);

        $config
            ->expects($this->once())
            ->method('getKey')
            ->willReturn($key);

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
     * @return MockObject|HandlerInterface
     */
    protected function getHandlerMock(RequestInterface $request, ResponseInterface $response, $value)
    {
        $handler = $this->createMock(HandlerInterface::class);
        $handler
            ->expects($this->once())
            ->method('handles')
            ->willReturn([get_class($request)]);
        $handler
            ->expects($this->once())
            ->method('toResponse')
            ->with($this->equalTo($response))
            ->willReturn($value);

        return $handler;
    }
}
