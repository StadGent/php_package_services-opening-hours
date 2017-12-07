<?php

namespace StadGent\Services\Test\OpeningHours;

use StadGent\Services\OpeningHours\ChannelService;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthHtmlRequest;
use StadGent\Services\OpeningHours\Response\HtmlResponse;

/**
 * Tests for ChannelService::openingHoursMonthHtml Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceOpeningHoursMonthHtmlTest extends ServiceTestBase
{
    /**
     * Test the HTML return string.
     */
    public function testOpeningHoursMonthHtml()
    {
        $html = $this->createOpeninghoursHtml();
        $client = $this->createClientForOpeningHoursMonthHtml($html);

        $channelService = new ChannelService($client);
        $responseHtml = $channelService->openingHoursMonthHtml(10, 20, '2020-01-02');
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow return HTML from cache.
     */
    public function testOpenNowHtmlFromCache()
    {
        $html = $this->createOpeninghoursHtml();
        $client = $this->createClientForOpeningHoursMonthHtml($html);
        $cache = $this->getFromCacheMock('OpeningHours:ChannelService:openingHoursMonthHtml:10:20:2020-01-02', $html);

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $responseHtml = $channelService->openingHoursMonthHtml(10, 20, '2020-01-02');
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow setCache when not yet cached.
     */
    public function testOpenNowHtmlSetCache()
    {
        $html = $this->createOpeninghoursHtml();
        $client = $this->createClientForOpeningHoursMonthHtml($html);
        $cache = $this->getSetCacheMock('OpeningHours:ChannelService:openingHoursMonthHtml:10:20:2020-01-02', $html);

        $channelService = new ChannelService($client);
        $channelService->setCacheService($cache);
        $channelService->openingHoursMonthHtml(10, 20, '2020-01-02');
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
        <time property="validFrom validThrough" datetime="2020-01-02">02/01</time>:  from
        <time property="opens" content="09:00:00">09:00</time> to
        <time property="closes" content="12:00:00">12:00</time>
    </div>
    <div property="openingHoursSpecification" typeof="OpeningHoursSpecification">
        <time property="validFrom validThrough" datetime="2020-01-03">03/01</time>:  from
        <time property="opens" content="09:00:00">09:00</time> to
        <time property="closes" content="12:00:00">12:00</time>
    </div>
    <div property="openingHoursSpecification" typeof="OpeningHoursSpecification">
        <time property="validFrom validThrough" datetime="2020-01-04">04/01</time>:  from
        <time property="opens" content="09:00:00">09:00</time> to
        <time property="closes" content="12:00:00">12:00</time>  from
        <time property="opens" content="14:00:00">14:00</time> to
        <time property="closes" content="16:00:00">16:00</time>
    </div>
    <div property="openingHoursSpecification" typeof="OpeningHoursSpecification">
        <time property="validFrom validThrough" datetime="2020-01-05">05/01</time>:  from
        <time property="opens" content="09:00:00">09:00</time> to
        <time property="closes" content="12:00:00">12:00</time>
    </div>
    <div property="openingHoursSpecification" typeof="OpeningHoursSpecification">
        <time property="validFrom validThrough" datetime="2020-01-06">06/01</time>:  from
        <time property="opens" content="09:00:00">09:00</time> to
        <time property="closes" content="12:00:00">12:00</time>
    </div>
    <div property="openingHoursSpecification" typeof="OpeningHoursSpecification">
        <time property="validFrom validThrough" datetime="2020-01-07">07/01</time>:
        <time property="closes" datetime="2020-01-07">closed</time>
    </div>
    <div property="openingHoursSpecification" typeof="OpeningHoursSpecification">
        <time property="validFrom validThrough" datetime="2020-01-08"">08/01</time>:
        <time property="closes" datetime="2020-01-08">closed</time>
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
    protected function createClientForOpeningHoursMonthHtml($html)
    {
        $response = new HtmlResponse($html);
        $expectedRequest = OpeningHoursMonthHtmlRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}