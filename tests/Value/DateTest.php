<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\Date;
use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Value\ValueInterface;

/**
 * Tests for the Date object.
 */
class DateTest extends TestCase
{
    /**
     * Test the format method.
     */
    public function testFormat()
    {
        $string = '2017-03-29';
        $date = new Date($string);
        $this->assertEquals('2017-03-29', $date->format());
        $this->assertEquals('29-03-2017', $date->format('d-m-Y'));
    }

    /**
     * Not the same value if the class is not the same.
     */
    public function testNotSameValueIfDifferentType()
    {
        $date = new Date('2025-12-31');
        $notDate = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notDate ValueInterface */
        $this->assertFalse(
            $date->sameValueAs($notDate),
            'Compared value object is not of Date type.'
        );
    }

    /**
     * Not the same if not the same content.
     */
    public function testNotSameValueIfDifferentContent()
    {
        $date = new Date('2017-03-29');
        $notSameDate = new Date('2017-03-30');
        $this->assertFalse(
            $date->sameValueAs($notSameDate),
            'Dates do not share the same values.'
        );
    }

    /**
     * Test SameValueAs method.
     */
    public function testSameValueAs()
    {
        $date = new Date('2017-03-29');
        $sameDate = new Date('2017-03-29');
        $this->assertTrue(
            $date->sameValueAs($sameDate),
            'Dates share the same values.'
        );
    }

    /**
     * Test toString method.
     */
    public function testToString()
    {
        $string = '2017-03-29';

        $date = new Date($string);
        $this->assertEquals(
            $string,
            (string) $date,
            'String version of date = date in format "Y-m-d"'
        );
    }
}
