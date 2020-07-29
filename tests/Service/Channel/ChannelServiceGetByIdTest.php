<?php

namespace StadGent\Services\Test\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Exception\ChannelNotFoundException;
use StadGent\Services\OpeningHours\Exception\ServiceNotFoundException;
use StadGent\Services\OpeningHours\Service\Channel\ChannelService;
use StadGent\Services\OpeningHours\Request\Channel\GetByIdRequest;
use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\OpeningHours\Value\Channel;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

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
        $cache = $this->getFromCacheMock('OpeningHours:channel:value:id:10:20', $channel);

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
        $cache = $this->getSetCacheMock('OpeningHours:channel:value:id:12:34', $channel);

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $channelService->getById(12, 34);
    }

    /**
     * Test the Service not found exception.
     */
    public function testServiceNotFoundException()
    {
        $this->expectException(ServiceNotFoundException::class);
        $client = $this->getClientWithServiceNotFoundExceptionMock();
        $channelService = new ChannelService($client);
        $channelService->getById(777, 666);
    }

    /**
     * Test the Channel not found exception.
     */
    public function testChannelNotFoundException()
    {
        $this->expectException(ChannelNotFoundException::class);
        $client = $this->getClientWithChannelNotFoundExceptionMock();
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
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    protected function createClientForChannel(Channel $channel)
    {
        $response = new ChannelResponse($channel);
        $expectedRequest = GetByIdRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
