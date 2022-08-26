<?php

namespace StadGent\Services\Test\OpeningHours;

use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\ChannelOpeningHoursHtml;
use DigipolisGent\API\Client\ClientInterface;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHtmlHandler;
use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursHtmlService;
use StadGent\Services\OpeningHours\Value\ChannelCollection;

/**
 * Tests the ChannelOpeningHoursHtmlServiceFactory.
 *
 * @package StadGent\Services\Test\OpeningHours
 *
 * @covers \StadGent\Services\OpeningHours\ChannelOpeningHoursHtml
 */
class ChannelOpeningHoursHtmlTest extends TestCase
{
    /**
     * Test creating the ChannelService.
     */
    public function testCreate()
    {
        // Handlers we expect to be added to the factory.
        $expectedHandlers = [
            OpenNowHtmlHandler::class,
            OpeningHoursHtmlHandler::class,
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
        $service = ChannelOpeningHoursHtml::create($client);
        $this->assertInstanceOf(
            OpeningHoursHtmlService::class,
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
        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects($this->any())
            ->method('addHandler')
            ->will($this->returnValue($client));

        $cache = $this->createMock(CacheInterface::class);
        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:channel:html:day:12:34:2020-01-02'))
            ->will($this->returnValue('<html></html>'));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = ChannelOpeningHoursHtml::create($client, $cache);

        $this->assertSame('<html></html>', $service->getDay(12, 34, '2020-01-02'));
    }
}
