<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use DigipolisGent\Value\ValueInterface;
use StadGent\Services\OpeningHours\Value\DateAttributes;
use StadGent\Services\OpeningHours\Value\Service;
use StadGent\Services\OpeningHours\Value\ServiceSource;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Service value object.
 *
 * @package StadGent\Services\Test\OpeningHours\Value
 *
 * @covers \StadGent\Services\OpeningHours\Value\Service
 */
class ServiceTest extends TestCase
{
    /**
     * Test from array with no source values in the array.
     */
    public function testFromEmptyArray()
    {
        $data = [
            'createdAt' => '2134-12-24T12:34:56+01:00',
            'updatedAt' => '2134-12-24T12:34:56+01:00',
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

        $this->assertFalse($service->isDraft());
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
            'createdAt' => '2345-11-05T12:45:00+01:00',
            'updatedAt' => '2345-11-12T14:12:11+01:00',
            'sourceIdentifier' => '654-987-321',
            'source' => 'foobar',
            'isDraft' => 1,
        ];
        $service = Service::fromArray($data);

        $this->assertEquals($data['id'], $service->getId());
        $this->assertEquals($data['uri'], $service->getUri());
        $this->assertEquals($data['label'], $service->getLabel());
        $this->assertEquals($data['description'], $service->getDescription());

        $source = ServiceSource::fromArray($data);
        $this->assertTrue($source->sameValueAs($service->getSource()));
        $this->assertTrue($service->hasSource());

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
            'createdAt' => '2345-11-05T12:45:00+01:00',
            'updatedAt' => '2345-11-12T14:12:11+01:00',
            'sourceIdentifier' => '654-987-321',
            'source' => 'foobar',
            'isDraft' => 1,
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
                'createdAt' => '2345-11-05T12:45:00+01:00',
                'updatedAt' => '2345-11-12T14:12:11+01:00',
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
                'createdAt' => '2134-12-24T12:34:56+01:00',
                'updatedAt' => '2134-12-24T12:34:56+01:00',
            ]
        );
        $this->assertEquals('', (string) $service);

        $service = Service::fromArray(
            [
                'label' => 'fooBar',
                'createdAt' => '2134-12-24T12:34:56+01:00',
                'updatedAt' => '2134-12-24T12:34:56+01:00',
            ]
        );
        $this->assertEquals('fooBar', (string) $service);
    }
}
