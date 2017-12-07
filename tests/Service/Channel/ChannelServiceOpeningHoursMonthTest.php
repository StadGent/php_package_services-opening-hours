<?php

namespace StadGent\Services\Test\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Service\Channel\ChannelOpeningHoursService;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthRequest;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use StadGent\Services\OpeningHours\Value\OpeningHours;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

/**
 * Tests for ChannelService::openingHoursMonthHtml Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceOpeningHoursMonthTest extends ServiceTestBase
{
    /**
     * Test the return object.
     */
    public function testOpeningHoursMonth()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);

        $channelService = new ChannelOpeningHoursService($client);
        $responseOpeningsHours = $channelService->getMonth(10, 20, '2020-01-02');
        $this->assertSame($openingHours, $responseOpeningsHours);
    }

    /**
     * Test the return object from cache.
     */
    public function testOpeningHoursMonthFromCache()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);
        $cache = $this->getFromCacheMock(
            'OpeningHours:ChannelOpeningHoursService:month:10:20:2020-01-02',
            $openingHours
        );

        $channelService = new ChannelOpeningHoursService($client);
        $channelService->setCacheService($cache);
        $responseOpeningHours = $channelService->getMonth(10, 20, '2020-01-02');
        $this->assertSame($openingHours, $responseOpeningHours);
    }

    /**
     * Test the setCache when not yet cached.
     */
    public function testOpeningHoursMonthSetCache()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);
        $cache = $this->getSetCacheMock(
            'OpeningHours:ChannelOpeningHoursService:month:12:34:2020-01-02',
            $openingHours
        );

        $channelService = new ChannelOpeningHoursService($client);
        $channelService->setCacheService($cache);
        $channelService->getMonth(12, 34, '2020-01-02');
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
        $expectedRequest = OpeningHoursMonthRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
