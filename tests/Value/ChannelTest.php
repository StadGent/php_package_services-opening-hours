<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\Channel;
use StadGent\Services\OpeningHours\Value\DateAttributes;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Service value object.
 *
 * @package StadGent\Services\Test\OpeningHours\Value
 */
class ChannelTest extends TestCase
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
            'serviceId' => 5,
            'createdAt' => '2345-11-05T12:45:00+01:00',
            'updatedAt' => '2345-11-12T14:12:11+01:00',
        ];
        $channel = Channel::fromArray($data);

        $this->assertEquals($data['id'], $channel->getId());
        $this->assertEquals($data['label'], $channel->getLabel());
        $this->assertEquals($data['serviceId'], $channel->getServiceId());
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
                'serviceId' => 5,
                'createdAt' => '2345-11-05T12:45:00+01:00',
                'updatedAt' => '2345-11-12T14:12:11+01:00',
            ]
        );
        $notChannel = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notChannel ValueInterface */
        $this->assertFalse(
            $channel->sameValueAs($notChannel),
            'Compared value object is not a Channel.'
        );
    }

    /**
     * Not the same if not the same content.
     */
    public function testNotSameValueIfDifferentContent()
    {
        $channel = Channel::fromArray(
            [
                'id' => 66,
                'label' => 'FooBar Label',
                'serviceId' => 5,
                'createdAt' => '2345-11-05T12:45:00+01:00',
                'updatedAt' => '2345-11-12T14:12:11+01:00',
            ]
        );

        $channelNotSame = Channel::fromArray(
            [
                'id' => 10,
                'label' => 'FizzBazz label',
                'serviceId' => 6,
                'createdAt' => '2345-11-05T12:45:00+01:00',
                'updatedAt' => '2345-11-12T14:12:11+01:00',
            ]
        );

        $this->assertFalse(
            $channel->sameValueAs($channelNotSame),
            'Channels do not share the same values.'
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
            'serviceId' => 5,
            'createdAt' => '2345-11-05T12:45:00+01:00',
            'updatedAt' => '2345-11-12T14:12:11+01:00',
        ];
        $channel = Channel::fromArray($data);

        $channelSame = Channel::fromArray($data);

        $this->assertTrue(
            $channel->sameValueAs($channelSame),
            'Channels share the same values.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $channel = Channel::fromArray(
            [
                'createdAt' => '2134-12-24T12:34:56+01:00',
                'updatedAt' => '2134-12-24T12:34:56+01:00',
            ]
        );
        $this->assertEquals('', (string) $channel);

        $channel = Channel::fromArray(
            [
                'label' => 'fooBar',
                'createdAt' => '2134-12-24T12:34:56+01:00',
                'updatedAt' => '2134-12-24T12:34:56+01:00',
            ]
        );
        $this->assertEquals('fooBar', (string) $channel);
    }
}
