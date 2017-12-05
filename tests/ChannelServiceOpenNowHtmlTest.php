<?php

namespace StadGent\Services\Test\OpeningHours;

use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\ChannelService;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowHtmlRequest;
use StadGent\Services\OpeningHours\Response\HtmlResponse;

/**
 * Tests for ServiceService::openNowHtml Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceOpenNowHtmlTest extends ServiceTestBase
{
    /**
     * Test the HTML return string.
     */
    public function testOpenNow()
    {
        $html = $this->createOpenNowHtml();
        $client = $this->createClientForOpenNowHtml($html);

        $channelService = new ChannelService($client);
        $responseHtml = $channelService->openNowHtml(10, 20);
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow return HTML from cache.
     */
    public function testOpenNowHtmlFromCache()
    {
        $html = $this->createOpenNowHtml();
        $client = $this->createClientForOpenNowHtml($html);

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ChannelService:openNowHtml:10:20'))
            ->will($this->returnValue($html));

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $responseHtml = $channelService->openNowHtml(10, 20);
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow setCache when not yet cached.
     */
    public function testOpenNowHtmlSetCache()
    {
        $html = $this->createOpenNowHtml();
        $client = $this->createClientForOpenNowHtml($html);

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ChannelService:openNowHtml:12:34'))
            ->will($this->returnValue(null));

        $cache
            ->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo('OpeningHours:ChannelService:openNowHtml:12:34'),
                $this->equalTo($html)
            );

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $channelService->openNowHtml(12, 34);
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
        $channelService->openNowHtml(777, 666);
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
        $channelService->openNowHtml(1, 666);
    }

    /**
     * Helper to create an OpenNow HTML string.
     *
     * @return string
     *   The HTML string.
     */
    protected function createOpenNowHtml()
    {
        return '<div>Open</div>';
    }

    /**
     * Helper to create a client that will return the given service.
     *
     * @param string $html
     *   The HTML string to return.
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForOpenNowHtml($html)
    {
        $response = new HtmlResponse($html);
        $expectedRequest = OpenNowHtmlRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
