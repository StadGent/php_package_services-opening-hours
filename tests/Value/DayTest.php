<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\Date;
use StadGent\Services\OpeningHours\Value\Day;
use StadGent\Services\OpeningHours\Value\HoursCollection;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Day value object.
 *
 * @package Gent\Zalenzoeker\Tests\Value
 */
class DayTest extends TestCase
{

    /**
     * Test exception when no date value in the array.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The array should contain a "date" value.
     */
    public function testExceptionWhenNoDateInArray()
    {
        $data = [];
        Day::fromArray($data);
    }

    /**
     * Test from array containing all values.
     */
    public function testFromArray()
    {
        $data = [
            'date' => '2020-02-01',
            'open' => true,
            'hours' => [
                [
                    'from' => '12:00',
                    'until' => '18:00',
                ],
            ],
        ];
        $day = Day::fromArray($data);

        $date = new Date($data['date']);
        $this->assertTrue($date->sameValueAs($day->getDate()));

        $this->assertTrue($day->isOpen());

        $hours = HoursCollection::fromArray($data['hours']);
        $this->assertTrue($hours->sameValueAs($day->getHours()));
    }

    /**
     * Test from empty array.
     */
    public function testFromEmptyArray()
    {
        $data = [
            'date' => '2020-02-01',
        ];
        $day = Day::fromArray($data);

        $this->assertFalse($day->isOpen());

        $hours = HoursCollection::fromArray([]);
        $this->assertTrue($hours->sameValueAs($day->getHours()));
    }

    /**
     * Test from array with no open state.
     */
    public function testFromArrayNotOpen()
    {
        $data = [
            'date' => '2020-02-01',
            'open' => false,
        ];
        $day = Day::fromArray($data);

        $this->assertFalse($day->isOpen());
    }

    /**
     * Not the same value if the class is not the same.
     */
    public function testNotSameValueIfDifferentType()
    {
        $day = Day::fromArray(
            [
                'date' => '2020-02-01',
            ]
        );
        $notDay = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notDay ValueInterface */
        $this->assertFalse(
            $day->sameValueAs($notDay),
            'Compared value object is not of Day type.'
        );
    }

    /**
     * Not the same if not the same content.
     */
    public function testNotSameValueIfDifferentContent()
    {
        $day = Day::fromArray(
            [
                'date' => '2020-02-01',
                'open' => true,
                'hours' => [
                    [
                        'from' => '12:00',
                        'until' => '18:00',
                    ],
                ],
            ]
        );

        $notSameDay = Day::fromArray(
            [
                'date' => '2020-02-01',
            ]
        );

        $this->assertFalse(
            $day->sameValueAs($notSameDay),
            'Days do not share the same values.'
        );
    }

    /**
     * Test same value as.
     */
    public function testSameValueAs()
    {
        $data = [
            'date' => '2020-02-01',
            'open' => true,
            'hours' => [
                [
                    'from' => '12:00',
                    'until' => '18:00',
                ],
            ],
        ];
        $day = Day::fromArray($data);

        $sameDay = Day::fromArray($data);

        $this->assertTrue(
            $day->sameValueAs($sameDay),
            'Days share the same values.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $day = Day::fromArray(
            [
                'date' => '2020-02-01',
                'open' => true,
                'hours' => [
                    [
                        'from' => '12:00',
                        'until' => '18:00',
                    ],
                ],
            ]
        );
        $this->assertEquals('2020-02-01', (string) $day);
    }
}
