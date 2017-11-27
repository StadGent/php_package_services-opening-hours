<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\Boolean;
use StadGent\Services\OpeningHours\Value\DateAttributes;
use StadGent\Services\OpeningHours\Value\Service;
use StadGent\Services\OpeningHours\Value\ServiceSource;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Service value object.
 *
 * @package Gent\Zalenzoeker\Tests\Value
 */
class ServiceTest extends TestCase
{

    /**
     * Test from array with no source values in the array.
     */
    public function testFromEmptyArray()
    {
        $data = [
            'created_at' => '2134-12-24 12:34:56',
            'updated_at' => '2134-12-24 12:34:56',
        ];
        $service = Service::fromArray($data);

        $this->assertNull($service->getId());
        $this->assertNull($service->getUri());
        $this->assertNull($service->getLabel());
        $this->assertNull($service->getDescription());

        $dateAttributes = DateAttributes::fromArray($data);
        $dateAttributes->sameValueAs($service->getDateAttributes());

        $emptySource = ServiceSource::fromArray([]);
        $this->assertTrue($emptySource->sameValueAs($service->getSource()));
        $this->assertFalse($service->hasSource());

        $booleanFalse = Boolean::false();
        $this->assertTrue($booleanFalse->sameValueAs($service->getDraft()));
        $this->assertFalse($service->isDraft());

        $this->assertEquals(0, $service->getCountChannels());
    }

    /**
     * Test from array containing values.
     */
    public function testFromArray()
    {
        $data = [
            'id' => 5,
            'uri' => 'https://foo.bar/item/5',
            'label' => 'FooBar Label',
            'description' => 'Description FooBar',
            'created_at' => '2345-11-05 12:45:00',
            'updated_at' => '2345-11-12 14:12:11',
            'identifier' => '654-987-321',
            'source' => 'foobar',
            'isDraft' => 1,
            'countChannels' => 5,
        ];
        $service = Service::fromArray($data);

        $this->assertEquals($data['id'], $service->getId());
        $this->assertEquals($data['uri'], $service->getUri());
        $this->assertEquals($data['label'], $service->getLabel());
        $this->assertEquals($data['description'], $service->getDescription());
        $this->assertEquals($data['countChannels'], $service->getCountChannels());

        $source = ServiceSource::fromArray($data);
        $this->assertTrue($source->sameValueAs($service->getSource()));
        $this->assertTrue($service->hasSource());

        $isDraft = Boolean::true();
        $this->assertTrue($isDraft->sameValueAs($service->getDraft()));
        $this->assertTrue($service->isDraft());
    }

    /**
     * Test same value as.
     */
    public function testSameValueAs()
    {
        $data = [
            'id' => 5,
            'uri' => 'https://foo.bar/item/5',
            'label' => 'FooBar Label',
            'description' => 'Description FooBar',
            'created_at' => '2345-11-05 12:45:00',
            'updated_at' => '2345-11-12 14:12:11',
            'identifier' => '654-987-321',
            'source' => 'foobar',
            'isDraft' => 1,
            'countChannels' => 5,
        ];
        $service = Service::fromArray($data);
        $notService = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notService ValueInterface */
        $this->assertFalse(
            $service->sameValueAs($notService),
            'Compared value object is not a Service.'
        );

        $serviceNotSame = Service::fromArray(
            [
                'id' => 10,
                'label' => 'FizzBazz label',
                'created_at' => '2345-11-05 12:45:00',
                'updated_at' => '2345-11-12 14:12:11',
            ]
        );
        $this->assertFalse(
            $service->sameValueAs($serviceNotSame),
            'Services do not share the same values.'
        );

        $serviceSame = Service::fromArray($data);
        $this->assertTrue(
            $service->sameValueAs($serviceSame),
            'Services share the same values.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $service = Service::fromArray(
            [
                'created_at' => '2134-12-24 12:34:56',
                'updated_at' => '2134-12-24 12:34:56',
            ]
        );
        $this->assertEquals('', (string) $service);

        $service = Service::fromArray(
            [
                'label' => 'fooBar',
                'created_at' => '2134-12-24 12:34:56',
                'updated_at' => '2134-12-24 12:34:56',
            ]
        );
        $this->assertEquals('fooBar', (string) $service);
    }
}
