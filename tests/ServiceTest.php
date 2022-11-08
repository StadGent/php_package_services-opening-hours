<?php

namespace StadGent\Services\Test\OpeningHours;

use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use DigipolisGent\API\Client\ClientInterface;
use StadGent\Services\OpeningHours\Handler\Service\GetAllHandler;
use StadGent\Services\OpeningHours\Handler\Service\GetByIdHandler;
use StadGent\Services\OpeningHours\Handler\Service\ExtractFirstHandler;
use StadGent\Services\OpeningHours\Handler\Service\SearchByLabelHandler;
use StadGent\Services\OpeningHours\Service;
use StadGent\Services\OpeningHours\Service\Service\ServiceService;
use StadGent\Services\OpeningHours\Value\ServiceCollection;

/**
 * Class RoomServiceFactoryTest
 *
 * @package Gent\Zalenzoeker\Tests\Services\Room
 *
 * @covers \StadGent\Services\OpeningHours\Service
 */
class ServiceTest extends TestCase
{
    /**
     * Test the create factory method.
     */
    public function testCreate()
    {
        // Handlers we expect to be added to the factory.
        $expectedHandlers = [
            GetAllHandler::class,
            GetByIdHandler::class,
            ExtractFirstHandler::class
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
        $service = Service::create($client);
        $this->assertInstanceOf(
            ServiceService::class,
            $service,
            'Service is an ServiceService.'
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
        $collection = ServiceCollection::fromArray([]);

        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects($this->any())
            ->method('addHandler')
            ->will($this->returnValue($client));

        $cache = $this->createMock(CacheInterface::class);
        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:service:value:all'))
            ->will($this->returnValue($collection));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = Service::create($client, $cache);

        $responseCollection = $service->getAll();
        $this->assertSame($collection, $responseCollection);
    }
}
