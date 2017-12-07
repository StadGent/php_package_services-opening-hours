<?php

namespace StadGent\Services\Test\OpeningHours;

use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Service\Channel\ChannelOpeningHoursService;
use StadGent\Services\OpeningHours\ChannelOpeningHoursServiceFactory;
use StadGent\Services\OpeningHours\Client\ClientInterface;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHandler;
use StadGent\Services\OpeningHours\Value\ChannelCollection;

/**
 * Tests the ChannelOpeningHoursServiceFactory.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelOpeningHoursServiceFactoryTest extends TestCase
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
        $client = $this
            ->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Inject a spy so we can validate the injected handlers.
        $spy = $this->any();
        $client
            ->expects($spy)
            ->method('addHandler')
            ->will($this->returnValue($client));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = ChannelOpeningHoursServiceFactory::create($client);
        $this->assertInstanceOf(
            ChannelOpeningHoursService::class,
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

        // Validate the added handlers.
        $invocations = $spy->getInvocations();
        foreach ($invocations as $invocation) {
             /** @noinspection PhpUndefinedFieldInspection */
             $handler = get_class($invocation->parameters[0]);
             $this->assertTrue(
                 in_array($handler, $expectedHandlers, true),
                 sprintf('Handler "%s" is added by the factory.', $handler)
             );
        }
    }

    /**
     * Test if the factory method sets the Cache to the Service.
     */
    public function testCreateWithCache()
    {
        $collection = ChannelCollection::fromArray([]);

        $client = $this
            ->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $client
            ->expects($this->any())
            ->method('addHandler')
            ->will($this->returnValue($client));

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ChannelOpeningHoursService:day:12:34:2020-01-02'))
            ->will($this->returnValue($collection));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = ChannelOpeningHoursServiceFactory::create($client, $cache);

        $responseCollection = $service->getDay(12, 34, '2020-01-02');
        $this->assertSame($collection, $responseCollection);
    }
}
