<?php

namespace StadGent\Services\Test\OpeningHours;

use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\ChannelService;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowRequest;
use StadGent\Services\OpeningHours\Response\OpenNowResponse;
use StadGent\Services\OpeningHours\Value\OpenNow;

/**
 * Tests for ServiceService::openNow Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceOpenNowTest extends ServiceTestBase
{
    /**
     * Test the openNow return object.
     */
    public function testOpenNow()
    {
        $openNow = $this->createOpenNow();
        $client = $this->createClientForOpenNow($openNow);

        $channelService = new ChannelService($client);
        $responseOpenNow = $channelService->openNow(10, 20);
        $this->assertSame($openNow, $responseOpenNow);
    }

    /**
     * Test the openNow return object from cache.
     */
    public function testOpenNowFromCache()
    {
        $openNow = $this->createOpenNow();
        $client = $this->createClientForOpenNow($openNow);

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ChannelService:openNow:10:20'))
            ->will($this->returnValue($openNow));

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $responseService = $channelService->openNow(10, 20);
        $this->assertSame($openNow, $responseService);
    }

    /**
     * Test the getByServiceAndChannelId setCache when not yet cached.
     */
    public function testOpenNowSetCache()
    {
        $openNow = $this->createOpenNow();
        $client = $this->createClientForOpenNow($openNow);

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ChannelService:openNow:12:34'))
            ->will($this->returnValue(null));

        $cache
            ->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo('OpeningHours:ChannelService:openNow:12:34'),
                $this->equalTo($openNow)
            );

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $channelService->openNow(12, 34);
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
        $channelService->openNow(777, 666);
    }

    /**
     * Test the Channel not found exception.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     */
    public function testChannelNotFoundException()
    {
        $client = $this->getClientWithChannelNotFoundExceptionMock();
        $channelService = new ChannelService($client);
        $channelService->openNow(1, 666);
    }

    /**
     * Helper to create an OpenNow object.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpenNow
     */
    protected function createOpenNow()
    {
        return OpenNow::fromArray(
            [
                'channel' => 'FizzBuzz',
                'channelId' => 123,
                'openNow' => [
                    'label' => 'open',
                    'status' => 'true',
                ],
            ]
        );
    }

    /**
     * Helper to create a client that will return the given service.
     *
     * @param \StadGent\Services\OpeningHours\Value\OpenNow $openNow
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForOpenNow(OpenNow $openNow)
    {
        $response = new OpenNowResponse($openNow);
        $expectedRequest = OpenNowRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
