<?php

namespace StadGent\Services\Test\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursService;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayRequest;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use StadGent\Services\OpeningHours\Value\OpeningHours;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

/**
 * Tests for ChannelService::openingHoursDayHtml Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceOpeningHoursDayTest extends ServiceTestBase
{
    /**
     * Test the openNow return object.
     */
    public function testOpeningHoursDay()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);

        $channelService = new OpeningHoursService($client);
        $responseOpeningsHours = $channelService->getDay(10, 20, '2020-01-02');
        $this->assertSame($openingHours, $responseOpeningsHours);
    }

    /**
     * Test the openNow return object from cache.
     */
    public function testOpeningHoursDayFromCache()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);
        $cache = $this->getFromCacheMock(
            'OpeningHours:channel:value:day:10:20:2020-01-02',
            $openingHours
        );

        $channelService = new OpeningHoursService($client);
        $channelService->setCacheService($cache);
        $responseOpeningHours = $channelService->getDay(10, 20, '2020-01-02');
        $this->assertSame($openingHours, $responseOpeningHours);
    }

    /**
     * Test the getByServiceAndChannelId setCache when not yet cached.
     */
    public function testOpeningHoursDaySetCache()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);
        $cache = $this->getSetCacheMock(
            'OpeningHours:channel:value:day:12:34:2020-01-02',
            $openingHours
        );

        $channelService = new OpeningHoursService($client);
        $channelService->setCacheService($cache);
        $channelService->getDay(12, 34, '2020-01-02');
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
        $channelService->getDay(777, 666, '2020-01-02');
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
        $channelService->getDay(1, 666, '2020-01-02');
    }

    /**
     * Helper to create an OpenNow object.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpeningHours
     */
    protected function createOpeningHours()
    {
        return OpeningHours::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openinghours' => [
                    '2022-04-01' => [
                        'date' => '2022-04-01',
                        'open' => false,
                        'hours' => [],
                    ],
                ],
            ]
        );
    }

    /**
     * Helper to create a client that will return the given service.
     *
     * @param \StadGent\Services\OpeningHours\Value\OpeningHours $openingHours
     *
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    protected function createClientForOpeningHours(OpeningHours $openingHours)
    {
        $response = new OpeningHoursResponse($openingHours);
        $expectedRequest = OpeningHoursDayRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
