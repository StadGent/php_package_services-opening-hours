<?php

namespace StadGent\Services\Test\OpeningHours;

use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\ChannelService;
use StadGent\Services\OpeningHours\ChannelServiceFactory;
use StadGent\Services\OpeningHours\Client\ClientInterface;
use StadGent\Services\OpeningHours\Handler\Channel\GetAllHandler;
use StadGent\Services\OpeningHours\Handler\Channel\GetByIdHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursDayHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursDayHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursMonthHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursMonthHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursWeekHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursWeekHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursYearHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursYearHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHtmlHandler;
use StadGent\Services\OpeningHours\Value\ChannelCollection;

/**
 * Class RoomServiceFactoryTest
 *
 * @package Gent\Zalenzoeker\Tests\Services\Room
 */
class ChannelServiceFactoryTest extends TestCase
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
            OpenNowHandler::class,
            OpenNowHtmlHandler::class,
            OpeningHoursDayHandler::class,
            OpeningHoursDayHtmlHandler::class,
            OpeningHoursWeekHandler::class,
            OpeningHoursWeekHtmlHandler::class,
            OpeningHoursMonthHandler::class,
            OpeningHoursMonthHtmlHandler::class,
            OpeningHoursYearHandler::class,
            OpeningHoursYearHtmlHandler::class,
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
        $service = ChannelServiceFactory::create($client);
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
            ->with($this->equalTo('OpeningHours:ChannelService:getAll:6'))
            ->will($this->returnValue($collection));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = ChannelServiceFactory::create($client, $cache);

        $responseCollection = $service->getAll(6);
        $this->assertSame($collection, $responseCollection);
    }
}
