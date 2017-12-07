<?php

namespace StadGent\Services\Test\OpeningHours;

use StadGent\Services\OpeningHours\ChannelOpeningHoursService;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodRequest;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use StadGent\Services\OpeningHours\Value\OpeningHours;

/**
 * Tests for ChannelService::openingHoursPeriodHtml Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceOpeningHoursPeriodTest extends ServiceTestBase
{
    /**
     * Test the return object.
     */
    public function testOpeningHoursPeriod()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);

        $channelService = new ChannelOpeningHoursService($client);
        $responseOpeningsHours = $channelService->openingHoursPeriod(10, 20, '2020-01-02', '2020-02-02');
        $this->assertSame($openingHours, $responseOpeningsHours);
    }

    /**
     * Test the return object from cache.
     */
    public function testOpeningHoursPeriodFromCache()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);
        $cache = $this->getFromCacheMock(
            'OpeningHours:ChannelOpeningHoursService:openingHoursPeriod:10:20:2020-01-02:2020-02-02',
            $openingHours
        );

        $channelService = new ChannelOpeningHoursService($client);
        $channelService->setCacheService($cache);
        $responseOpeningHours = $channelService->openingHoursPeriod(10, 20, '2020-01-02', '2020-02-02');
        $this->assertSame($openingHours, $responseOpeningHours);
    }

    /**
     * Test the setCache when not yet cached.
     */
    public function testOpeningHoursPeriodSetCache()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);
        $cache = $this->getSetCacheMock(
            'OpeningHours:ChannelOpeningHoursService:openingHoursPeriod:12:34:2020-01-02:2020-02-02',
            $openingHours
        );

        $channelService = new ChannelOpeningHoursService($client);
        $channelService->setCacheService($cache);
        $channelService->openingHoursPeriod(12, 34, '2020-01-02', '2020-02-02');
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
                    '2022-04-02' => [
                        'date' => '2022-04-02',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-03' => [
                        'date' => '2022-04-03',
                        'open' => false,
                        'hours' => [
                            [
                                'from' => '09:00',
                                'until' => '12:00',
                            ],
                        ],
                    ],
                    '2022-04-04' => [
                        'date' => '2022-04-04',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-05' => [
                        'date' => '2022-04-05',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-06' => [
                        'date' => '2022-04-06',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-07' => [
                        'date' => '2022-04-07',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-08' => [
                        'date' => '2022-04-08',
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
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForOpeningHours(OpeningHours $openingHours)
    {
        $response = new OpeningHoursResponse($openingHours);
        $expectedRequest = OpeningHoursPeriodRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
