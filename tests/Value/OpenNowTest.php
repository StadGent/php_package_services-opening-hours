<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use DigipolisGent\Value\ValueInterface;
use StadGent\Services\OpeningHours\Value\OpenNow;
use PHPUnit\Framework\TestCase;

/**
 * Tests the OpeningHours value object.
 *
 * @package StadGent\Services\Test\OpeningHours\Value
 *
 * @covers \StadGent\Services\OpeningHours\Value\OpenNow
 */
class OpenNowTest extends TestCase
{

    /**
     * Test exception when no channel value in the array.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The array should contain a "channel" value.
     */
    public function testExceptionWhenNoChannelInArray()
    {
        $data = [];
        OpenNow::fromArray($data);
    }

    /**
     * Test exception when no channelId value in the array.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The array should contain a "channelId" value.
     */
    public function testExceptionWhenNoChannelIdInArray()
    {
        $data = [
            'channel' => 'fooBar',
        ];
        OpenNow::fromArray($data);
    }

    /**
     * Test from array containing all values.
     */
    public function testFromArray()
    {
        $data = [
            'channel' => 'fooBar',
            'channelId' => 15,
            'openNow' => [
                'status' => true,
                'label' => 'open',
            ],
        ];
        $openNow = OpenNow::fromArray($data);

        $this->assertEquals($data['channelId'], $openNow->getChannelId());
        $this->assertEquals($data['channel'], $openNow->getChannelLabel());
        $this->assertTrue($openNow->isOpen());
    }

    /**
     * Test from array containing an not open state.
     */
    public function testFromArrayWithNoOpenState()
    {
        $data = [
            'channel' => 'fooBar',
            'channelId' => 15,
            'openNow' => [
                'status' => false,
                'label' => 'closed',
            ],
        ];
        $openNow = OpenNow::fromArray($data);

        $this->assertFalse($openNow->isOpen());
    }

    /**
     * Test from empty array.
     */
    public function testFromEmptyArray()
    {
        $data = [
            'channel' => 'fooBar',
            'channelId' => 15,
        ];
        $openNow = OpenNow::fromArray($data);
        $this->assertFalse($openNow->isOpen());
    }

    /**
     * Not the same value if the class is not the same.
     */
    public function testNotSameValueIfDifferentType()
    {
        $openNow = OpenNow::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openNow' => [
                    'status' => true,
                    'label' => 'open',
                ],
            ]
        );
        $notOpenNow = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notOpenNow ValueInterface */
        $this->assertFalse(
            $openNow->sameValueAs($notOpenNow),
            'Compared value object is not of OpenNow type.'
        );
    }

    /**
     * Not the same if not the same content.
     */
    public function testNotSameValueIfDifferentContent()
    {
        $openNow = OpenNow::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openNow' => [
                    'status' => true,
                    'label' => 'open',
                ],
            ]
        );

        $notSameOpenNow = OpenNow::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openNow' => [
                    'status' => false,
                    'label' => 'closed',
                ],
            ]
        );

        $this->assertFalse(
            $openNow->sameValueAs($notSameOpenNow),
            'OpenNow objects do not share the same values.'
        );
    }

    /**
     * Test same value as.
     */
    public function testSameValueAs()
    {
        $data = [
            'channel' => 'fooBar',
            'channelId' => 15,
            'openNow' => [
                'status' => true,
                'label' => 'open',
            ],
        ];
        $openNow = OpenNow::fromArray($data);
        $sameOpenNow = OpenNow::fromArray($data);

        $this->assertTrue(
            $openNow->sameValueAs($sameOpenNow),
            'OpenNow objects share the same values.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $openingHours = OpenNow::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openNow' => [
                    'status' => true,
                    'label' => 'open',
                ],
            ]
        );
        $this->assertEquals('fooBar', (string) $openingHours);
    }
}
