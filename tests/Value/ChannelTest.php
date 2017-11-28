<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\Channel;
use StadGent\Services\OpeningHours\Value\DateAttributes;
use StadGent\Services\OpeningHours\Value\Service;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Service value object.
 *
 * @package Gent\Zalenzoeker\Tests\Value
 */
class ChannelTest extends TestCase
{

    /**
     * Test from array with no source values in the array.
     */
    public function testFromEmptyArray()
    {
        $data = [
            'created_at' => '2134-12-24T12:34:56+01:00',
            'updated_at' => '2134-12-24T12:34:56+01:00',
        ];
        $channel = Channel::fromArray($data);

        $this->assertNull($channel->getId());
        $this->assertNull($channel->getLabel());
        $this->assertNull($channel->getServiceId());

        $dateAttributes = DateAttributes::fromArray($data);
        $dateAttributes->sameValueAs($channel->getDateAttributes());
    }

    /**
     * Test from array containing values.
     */
    public function testFromArray()
    {
        $data = [
            'id' => 66,
            'label' => 'FooBar Label',
            'service_id' => 5,
            'created_at' => '2345-11-05T12:45:00+01:00',
            'updated_at' => '2345-11-12T14:12:11+01:00',
        ];
        $channel = Channel::fromArray($data);

        $this->assertEquals($data['id'], $channel->getId());
        $this->assertEquals($data['label'], $channel->getLabel());
        $this->assertEquals($data['service_id'], $channel->getServiceId());
    }

    /**
     * Not the same value if the class is not the same.
     */
    public function testNotSameValueIfDifferentType()
    {
        $channel = Channel::fromArray(
            [
                'id' => 66,
                'label' => 'FooBar Label',
                'service_id' => 5,
                'created_at' => '2345-11-05T12:45:00+01:00',
                'updated_at' => '2345-11-12T14:12:11+01:00',
            ]
        );
        $notService = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notService ValueInterface */
        $this->assertFalse(
            $channel->sameValueAs($notService),
            'Compared value object is not a Service.'
        );
    }

    /**
     * Not the same if not equal amount of items.
     */
    public function testNotSameValueIfDifferentContent()
    {
        $channel = Channel::fromArray(
            [
                'id' => 66,
                'label' => 'FooBar Label',
                'service_id' => 5,
                'created_at' => '2345-11-05T12:45:00+01:00',
                'updated_at' => '2345-11-12T14:12:11+01:00',
            ]
        );

        $serviceNotSame = Channel::fromArray(
            [
                'id' => 10,
                'label' => 'FizzBazz label',
                'service_id' => 6,
                'created_at' => '2345-11-05T12:45:00+01:00',
                'updated_at' => '2345-11-12T14:12:11+01:00',
            ]
        );

        $this->assertFalse(
            $channel->sameValueAs($serviceNotSame),
            'Services do not share the same values.'
        );
    }

    /**
     * Test same value as.
     */
    public function testSameValueAs()
    {
        $data = [
            'id' => 66,
            'label' => 'FooBar Label',
            'service_id' => 5,
            'created_at' => '2345-11-05T12:45:00+01:00',
            'updated_at' => '2345-11-12T14:12:11+01:00',
        ];
        $channel = Channel::fromArray($data);

        $serviceSame = Channel::fromArray($data);

        $this->assertTrue(
            $channel->sameValueAs($serviceSame),
            'Services share the same values.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $channel = Channel::fromArray(
            [
                'created_at' => '2134-12-24T12:34:56+01:00',
                'updated_at' => '2134-12-24T12:34:56+01:00',
            ]
        );
        $this->assertEquals('', (string) $channel);

        $channel = Channel::fromArray(
            [
                'label' => 'fooBar',
                'created_at' => '2134-12-24T12:34:56+01:00',
                'updated_at' => '2134-12-24T12:34:56+01:00',
            ]
        );
        $this->assertEquals('fooBar', (string) $channel);
    }
}
