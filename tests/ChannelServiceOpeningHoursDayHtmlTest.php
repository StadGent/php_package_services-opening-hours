<?php

namespace StadGent\Services\Test\OpeningHours;

use StadGent\Services\OpeningHours\ChannelService;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest;
use StadGent\Services\OpeningHours\Response\HtmlResponse;

/**
 * Tests for ChannelService::openingHoursDayHtml Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceOpeningHoursDayHtmlTest extends ServiceTestBase
{
    /**
     * Test the HTML return string.
     */
    public function testOpeningHoursDayHtml()
    {
        $html = $this->createOpeninghoursHtml();
        $client = $this->createClientForOpeningHoursDayHtml($html);

        $channelService = new ChannelService($client);
        $responseHtml = $channelService->openingHoursDayHtml(10, 20, '2020-01-02');
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow return HTML from cache.
     */
    public function testOpenNowHtmlFromCache()
    {
        $html = $this->createOpeninghoursHtml();
        $client = $this->createClientForOpeningHoursDayHtml($html);
        $cache = $this->getFromCacheMock('OpeningHours:ChannelService:openingHoursDayHtml:10:20:2020-01-02', $html);

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $responseHtml = $channelService->openingHoursDayHtml(10, 20, '2020-01-02');
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow setCache when not yet cached.
     */
    public function testOpenNowHtmlSetCache()
    {
        $html = $this->createOpeninghoursHtml();
        $client = $this->createClientForOpeningHoursDayHtml($html);
        $cache = $this->getSetCacheMock('OpeningHours:ChannelService:openingHoursDayHtml:10:20:2020-01-02', $html);

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $channelService->openingHoursDayHtml(10, 20, '2020-01-02');
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
        $channelService->openingHoursDayHtml(10, 20, '2020-01-02');
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
        $channelService->openingHoursDayHtml(10, 20, '2020-01-02');
    }

    /**
     * Helper to create an OpenNow HTML string.
     *
     * @return string
     *   The HTML string.
     */
    protected function createOpeninghoursHtml()
    {
        return <<<EOT
<div vocab="http://schema.org/" typeof="Library">
    <h1>FooBar</h1>
    <div property="openingHoursSpecification" typeof="OpeningHoursSpecification">
        <time property="validFrom validThrough" datetime="2020-01-02">12/12</time>:  from
        <time property="opens" content="09:00:00">09:00</time> to
        <time property="closes" content="12:00:00">12:00</time>
    </div>
</div>
EOT;

    }

    /**
     * Helper to create a client that will return the given service.
     *
     * @param string $html
     *   The HTML string to return.
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForOpeningHoursDayHtml($html)
    {
        $response = new HtmlResponse($html);
        $expectedRequest = OpeningHoursDayHtmlRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
