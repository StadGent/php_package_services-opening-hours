<?php

namespace StadGent\Services\Test\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Exception\ChannelNotFoundException;
use StadGent\Services\OpeningHours\Exception\ServiceNotFoundException;
use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursHtmlService;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayHtmlRequest;
use StadGent\Services\OpeningHours\Response\HtmlResponse;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

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

        $channelService = new OpeningHoursHtmlService($client);
        $responseHtml = $channelService->getDay(10, 20, '2020-01-02');
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow return HTML from cache.
     */
    public function testOpenNowHtmlFromCache()
    {
        $html = $this->createOpeninghoursHtml();
        $client = $this->createClientForOpeningHoursDayHtml($html);
        $cache = $this->getFromCacheMock('OpeningHours:channel:html:day:10:20:2020-01-02', $html);

        $channelService = new OpeningHoursHtmlService($client);
        $channelService->setCacheService($cache);
        $responseHtml = $channelService->getDay(10, 20, '2020-01-02');
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow setCache when not yet cached.
     */
    public function testOpenNowHtmlSetCache()
    {
        $html = $this->createOpeninghoursHtml();
        $client = $this->createClientForOpeningHoursDayHtml($html);
        $cache = $this->getSetCacheMock('OpeningHours:channel:html:day:10:20:2020-01-02', $html);

        $channelService = new OpeningHoursHtmlService($client);
        $channelService->setCacheService($cache);
        $channelService->getDay(10, 20, '2020-01-02');
    }

    /**
     * Test the Service not found exception.
     */
    public function testServiceNotFoundException()
    {
        $this->expectException(ServiceNotFoundException::class);
        $client = $this->getClientWithServiceNotFoundExceptionMock();
        $channelService = new OpeningHoursHtmlService($client);
        $channelService->getDay(10, 20, '2020-01-02');
    }

    /**
     * Test the Channel not found exception.
     */
    public function testChannelNotFoundException()
    {
        $this->expectException(ChannelNotFoundException::class);
        $client = $this->getClientWithChannelNotFoundExceptionMock();
        $channelService = new OpeningHoursHtmlService($client);
        $channelService->getDay(10, 20, '2020-01-02');
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
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    protected function createClientForOpeningHoursDayHtml($html)
    {
        $response = new HtmlResponse($html);
        $expectedRequest = OpeningHoursDayHtmlRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
