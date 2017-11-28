<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\DayCollection;
use StadGent\Services\OpeningHours\Value\OpeningHours;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Tests the OpeningHours value object.
 *
 * @package Gent\Zalenzoeker\Tests\Value
 */
class OpeningHoursTest extends TestCase
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
        OpeningHours::fromArray($data);
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
        OpeningHours::fromArray($data);
    }

    /**
     * Test from array containing all values.
     */
    public function testFromArray()
    {
        $data = [
            'channel' => 'fooBar',
            'channelId' => 15,
            'openinghours' => [
                '2022-04-01' => [
                    'date' => '2022-04-01',
                ],
            ],
        ];
        $openingHours = OpeningHours::fromArray($data);

        $this->assertEquals($data['channelId'], $openingHours->getChannelId());
        $this->assertEquals($data['channel'], $openingHours->getChannelLabel());

        $days = DayCollection::fromArray($data['openinghours']);
        $this->assertTrue($days->sameValueAs($openingHours->getDays()));
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
        $openingHours = OpeningHours::fromArray($data);

        $days = DayCollection::fromArray([]);
        $this->assertTrue($days->sameValueAs($openingHours->getDays()));
    }

    /**
     * Not the same value if the class is not the same.
     */
    public function testNotSameValueIfDifferentType()
    {
        $openingHours = OpeningHours::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
            ]
        );
        $notOpeningHours = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notOpeningHours ValueInterface */
        $this->assertFalse(
            $openingHours->sameValueAs($notOpeningHours),
            'Compared value object is not of OpeningHours type.'
        );
    }

    /**
     * Not the same if not the same content.
     */
    public function testNotSameValueIfDifferentContent()
    {
        $openingHours = OpeningHours::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openinghours' => [
                    '2022-04-01' => [
                        'date' => '2022-04-01',
                    ],
                ],
            ]
        );

        $notSameOpeningHours = OpeningHours::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openinghours' => [],
            ]
        );

        $this->assertFalse(
            $openingHours->sameValueAs($notSameOpeningHours),
            'Days do not share the same values.'
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
            'openinghours' => [
                '2022-04-01' => [
                    'date' => '2022-04-01',
                ],
            ],
        ];
        $openingHours = OpeningHours::fromArray($data);

        $sameOpeningHours = OpeningHours::fromArray($data);

        $this->assertTrue(
            $openingHours->sameValueAs($sameOpeningHours),
            'OpeningHours share the same values.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $openingHours = OpeningHours::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openinghours' => [
                    '2022-04-01' => [
                        'date' => '2022-04-01',
                    ],
                ],
            ]
        );
        $this->assertEquals('fooBar', (string) $openingHours);
    }
}
