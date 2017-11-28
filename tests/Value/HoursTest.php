<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\Hours;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Hours value object.
 *
 * @package Gent\Zalenzoeker\Tests\Value
 */
class HoursTest extends TestCase
{

    /**
     * Test exception when no created_at value in the array.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The array should contain a "from" value.
     */
    public function testExceptionWhenNoFromInArray()
    {
        $data = [];
        Hours::fromArray($data);
    }

    /**
     * Test exception when no updated_at value in the array.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The array should contain an "until" value.
     */
    public function testExceptionWhenNoUpdatedAtInArray()
    {
        $data = [
            'from' => '12:13'
        ];
        Hours::fromArray($data);
    }

    /**
     * Test from array containing values.
     */
    public function testFromArray()
    {
        $data = [
            'from' => '12:12',
            'until' => '18:30',
        ];
        $hours = Hours::fromArray($data);

        $this->assertEquals($data['from'], $hours->getFromHour());
        $this->assertEquals($data['until'], $hours->getUntilHour());
    }

    /**
     * Not the same value if the class is not the same.
     */
    public function testNotSameValueIfDifferentType()
    {
        $hours = Hours::fromArray(
            [
                'from' => '12:12',
                'until' => '18:30',
            ]
        );
        $notService = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notService ValueInterface */
        $this->assertFalse(
            $hours->sameValueAs($notService),
            'Compared value object is not of Hours type.'
        );
    }

    /**
     * Not the same if not the same content.
     */
    public function testNotSameValueIfDifferentContent()
    {
        $hours = Hours::fromArray(
            [
                'from' => '12:12',
                'until' => '18:30',
            ]
        );

        $notSameHours = Hours::fromArray(
            [
                'from' => '12:00',
                'until' => '18:15',
            ]
        );

        $this->assertFalse(
            $hours->sameValueAs($notSameHours),
            'Hours do not share the same values.'
        );
    }

    /**
     * Test same value as.
     */
    public function testSameValueAs()
    {
        $data = [
            'from' => '12:00',
            'until' => '18:15',
        ];
        $hours = Hours::fromArray($data);

        $hoursSame = Hours::fromArray($data);

        $this->assertTrue(
            $hours->sameValueAs($hoursSame),
            'Hours share the same values.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $hours = Hours::fromArray(
            [
                'from' => '10:00',
                'until' => '20:30',
            ]
        );
        $this->assertEquals('10:00 > 20:30', (string) $hours);
    }
}
