<?php

namespace StadGent\Services\Test\OpeningHours;

use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursService;
use StadGent\Services\OpeningHours\ChannelOpeningHours;
use DigipolisGent\API\Client\ClientInterface;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHandler;
use StadGent\Services\OpeningHours\Value\ChannelCollection;
use StadGent\Services\OpeningHours\Value\OpeningHours;

/**
 * Tests the ChannelOpeningHoursServiceFactory.
 *
 * @package StadGent\Services\Test\OpeningHours
 *
 * @covers \StadGent\Services\OpeningHours\ChannelOpeningHours
 */
class ChannelOpeningHoursTest extends TestCase
{
    /**
     * Test creating the ChannelService.
     */
    public function testCreate()
    {
        // Handlers we expect to be added to the factory.
        $expectedHandlers = [
            OpenNowHandler::class,
            OpeningHoursHandler::class,
        ];

        // Create the client so we can spy on the factory method.
        $client = $this->createMock(ClientInterface::class);

        // Inject a spy so we can validate the injected handlers.
        $spy = $this->any();
        $client
            ->expects($spy)
            ->method('addHandler')
            ->will($this->returnValue($client));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = ChannelOpeningHours::create($client);
        $this->assertInstanceOf(
            OpeningHoursService::class,
            $service,
            'Service is an ChannelOpeningHoursService.'
        );

        // Validate the number of handlers added.
        $expectedCount = count($expectedHandlers);
        $handlerCount = $spy->getInvocationCount();
        $this->assertSame(
            $expectedCount,
            $handlerCount,
            sprintf('%d handlers are added', $expectedCount)
        );
    }

    /**
     * Test if the factory method sets the Cache to the Service.
     */
    public function testCreateWithCache()
    {
        $openingHours = OpeningHours::fromArray([
            'channelId' => '123',
            'channel' => 'Channel',
        ]);

        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects($this->any())
            ->method('addHandler')
            ->will($this->returnValue($client));

        $cache = $this->createMock(CacheInterface::class);
        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:channel:value:day:12:34:2020-01-02'))
            ->will($this->returnValue($openingHours));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = ChannelOpeningHours::create($client, $cache);

        $this->assertSame(
            $openingHours,
            $service->getDay(12, 34, '2020-01-02')
        );
    }
}
