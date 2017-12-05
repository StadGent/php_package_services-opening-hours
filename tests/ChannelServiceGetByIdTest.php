<?php

namespace StadGent\Services\Test\OpeningHours;

use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\ChannelService;
use StadGent\Services\OpeningHours\Request\Channel\GetByIdRequest;
use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\OpeningHours\Value\Channel;

/**
 * Tests for ServiceService::getById Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceGetByIdTest extends ServiceTestBase
{
    /**
     * Test the getByServiceAndChannelId return object.
     */
    public function testGetByServiceAndChannelId()
    {
        $channel = $this->createChannel();
        $client = $this->createClientForChannel($channel);

        $channelService = new ChannelService($client);
        $responseChannel = $channelService->getById(10, 20);
        $this->assertSame($channel, $responseChannel);
    }

    /**
     * Test the getByServiceAndChannelId return object from cache.
     */
    public function testGetByServiceAndChannelIdFromCache()
    {
        $channel = $this->createChannel();
        $client = $this->createClientForChannel($channel);

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ChannelService:getById:10:20'))
            ->will($this->returnValue($channel));

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $responseService = $channelService->getById(10, 20);
        $this->assertSame($channel, $responseService);
    }

    /**
     * Test the getByServiceAndChannelId setCache when not yet cached.
     */
    public function testGetByServiceAndChannelIdSetCache()
    {
        $channel = $this->createChannel();
        $client = $this->createClientForChannel($channel);

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ChannelService:getById:12:34'))
            ->will($this->returnValue(null));

        $cache
            ->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo('OpeningHours:ChannelService:getById:12:34'),
                $this->equalTo($channel)
            );

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $channelService->getById(12, 34);
    }

    /**
     * Test the Service not found exception.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function testServiceNotFoundException()
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
        $client = $this->getClientWithExceptionMock($exceptionMock);
        $channelService = new ChannelService($client);
        $channelService->getById(777, 666);
    }

    /**
     * Test the Channel not found exception.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     */
    public function testChannelNotFoundException()
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
        $client = $this->getClientWithExceptionMock($exceptionMock);
        $channelService = new ChannelService($client);
        $channelService->getById(1, 666);
    }

    /**
     * Helper to create a Channel.
     *
     * @return \StadGent\Services\OpeningHours\Value\Channel
     */
    protected function createChannel()
    {
        return Channel::fromArray(
            [
                'id' => 10,
                'label' => 'FizzBazz label',
                'serviceId' => 1,
                'createdAt' => '2345-11-05T12:45:00+01:00',
                'updatedAt' => '2345-11-12T14:12:11+01:00',
            ]
        );
    }

    /**
     * Helper to create a client that will return the given service.
     *
     * @param \StadGent\Services\OpeningHours\Value\Channel $channel
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForChannel(Channel $channel)
    {
        $response = new ChannelResponse($channel);
        $expectedRequest = GetByIdRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
