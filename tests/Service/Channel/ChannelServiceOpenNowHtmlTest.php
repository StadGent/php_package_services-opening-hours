<?php

namespace StadGent\Services\Test\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Exception\ChannelNotFoundException;
use StadGent\Services\OpeningHours\Exception\ServiceNotFoundException;
use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursHtmlService;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowHtmlRequest;
use StadGent\Services\OpeningHours\Response\HtmlResponse;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

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

        $channelService = new OpeningHoursHtmlService($client);
        $responseHtml = $channelService->getOpenNow(10, 20);
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the Service not found exception.
     */
    public function testServiceNotFoundException()
    {
        $this->expectException(ServiceNotFoundException::class);
        $client = $this->getClientWithServiceNotFoundExceptionMock();
        $channelService = new OpeningHoursHtmlService($client);
        $channelService->getOpenNow(777, 666);
    }

    /**
     * Test the Channel not found exception.
     */
    public function testChannelNotFoundException()
    {
        $this->expectException(ChannelNotFoundException::class);
        $client = $this->getClientWithChannelNotFoundExceptionMock();
        $channelService = new OpeningHoursHtmlService($client);
        $channelService->getOpenNow(1, 666);
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
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    protected function createClientForOpenNowHtml($html)
    {
        $response = new HtmlResponse($html);
        $expectedRequest = OpenNowHtmlRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
