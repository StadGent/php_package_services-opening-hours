<?php

namespace StadGent\Services\Test\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursService;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowRequest;
use StadGent\Services\OpeningHours\Response\OpenNowResponse;
use StadGent\Services\OpeningHours\Value\OpenNow;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

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

        $channelService = new OpeningHoursService($client);
        $responseOpenNow = $channelService->getOpenNow(10, 20);
        $this->assertSame($openNow, $responseOpenNow);
    }

    /**
     * Test the Service not found exception.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function testServiceNotFoundException()
    {
        $client = $this->getClientWithServiceNotFoundExceptionMock();
        $channelService = new OpeningHoursService($client);
        $channelService->getOpenNow(777, 666);
    }

    /**
     * Test the Channel not found exception.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     */
    public function testChannelNotFoundException()
    {
        $client = $this->getClientWithChannelNotFoundExceptionMock();
        $channelService = new OpeningHoursService($client);
        $channelService->getOpenNow(1, 666);
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
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    protected function createClientForOpenNow(OpenNow $openNow)
    {
        $response = new OpenNowResponse($openNow);
        $expectedRequest = OpenNowRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
