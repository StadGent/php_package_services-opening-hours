<?php

namespace StadGent\Services\Test\OpeningHours;

use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Service\Channel\ChannelService;
use StadGent\Services\OpeningHours\Channel;
use DigipolisGent\API\Client\ClientInterface;
use StadGent\Services\OpeningHours\Handler\Channel\GetAllHandler;
use StadGent\Services\OpeningHours\Handler\Channel\GetByIdHandler;
use StadGent\Services\OpeningHours\Value\ChannelCollection;

/**
 * Class RoomServiceFactoryTest
 *
 * @package Gent\Zalenzoeker\Tests\Services\Room
 *
 * @covers \StadGent\Services\OpeningHours\Channel
 */
class ChannelTest extends TestCase
{

    /**
     * Test creating the ChannelService.
     */
    public function testCreate()
    {
        // Handlers we expect to be added to the factory.
        $expectedHandlers = [
            GetAllHandler::class,
            GetByIdHandler::class,
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
        $service = Channel::create($client);
        $this->assertInstanceOf(
            ChannelService::class,
            $service,
            'Channel is an ChannelService.'
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
        $collection = ChannelCollection::fromArray([]);

        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects($this->any())
            ->method('addHandler')
            ->will($this->returnValue($client));

        $cache = $this->createMock(CacheInterface::class);
        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:channel:value:all:6'))
            ->will($this->returnValue($collection));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = Channel::create($client, $cache);

        $responseCollection = $service->getAll(6);
        $this->assertSame($collection, $responseCollection);
    }
}
