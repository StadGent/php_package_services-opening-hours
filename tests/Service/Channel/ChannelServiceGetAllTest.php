<?php

namespace StadGent\Services\Test\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Service\Channel\ChannelService;
use StadGent\Services\OpeningHours\Request\Channel\GetAllRequest;
use StadGent\Services\OpeningHours\Response\ChannelsResponse;
use StadGent\Services\OpeningHours\Value\ChannelCollection;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

/**
 * Tests for ServiceService::getAll method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceGetAllTest extends ServiceTestBase
{
    /**
     * Test the GetAllByServiceId return object.
     */
    public function testGetAllByServiceId()
    {
        $channelCollection = $this->createChannelCollection();
        $client = $this->createClientForChannelCollection($channelCollection);

        $channelService = new ChannelService($client);
        $responseServiceCollection = $channelService->getAll(1);
        $this->assertSame($channelCollection, $responseServiceCollection);
    }

    /**
     * Test the GetAllByServiceId return object from cache.
     */
    public function testGetAllByServiceIdFromCache()
    {
        $channelCollection = $this->createChannelCollection();
        $client = $this->createClientForChannelCollection($channelCollection);
        $cache = $this->getFromCacheMock('OpeningHours:ChannelService:getAll:5', $channelCollection);

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);

        $responseServiceCollection = $channelService->getAll(5);
        $this->assertSame($channelCollection, $responseServiceCollection);
    }

    /**
     * Test the getAll setCache return object without cache.
     */
    public function testGetAllByServiceIdSetCache()
    {
        $channelCollection = $this->createChannelCollection();
        $client = $this->createClientForChannelCollection($channelCollection);
        $cache = $this->getSetCacheMock('OpeningHours:ChannelService:getAll:6', $channelCollection);

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $channelService->getAll(6);
    }

    /**
     * Test the GetAll method UnexpectedResponseException.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    public function testUnexpectedResponseException()
    {
        $response = $this->getResponseDummyMock();
        $client = $this->getClientMock($response);
        $channelService = new ChannelService($client);
        $channelService->getAll(7);
    }

    /**
     * Test the Service not found exception.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function testServiceNotFoundException()
    {
        $client = $this->getClientWithServiceNotFoundExceptionMock();
        $channelService = new ChannelService($client);
        $channelService->getAll(777);
    }

    /**
     * Helper to create the client response.
     *
     * @return \StadGent\Services\OpeningHours\Value\ChannelCollection
     */
    protected function createChannelCollection()
    {
        return ChannelCollection::fromArray([]);
    }

    /**
     * Helper to create a client that will return the given ServiceCollection.
     *
     * @param \StadGent\Services\OpeningHours\Value\ChannelCollection $channelCollection
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForChannelCollection(ChannelCollection $channelCollection)
    {
        $response = new ChannelsResponse($channelCollection);
        $expectedRequest = GetAllRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
