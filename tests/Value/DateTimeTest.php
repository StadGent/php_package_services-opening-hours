<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use DigipolisGent\Value\ValueInterface;
use StadGent\Services\OpeningHours\Value\DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the DateTime object.
 *
 * @package StadGent\Services\Test\OpeningHours\Value
 *
 * @covers \StadGent\Services\OpeningHours\Value\DateTime
 */
class DateTimeTest extends TestCase
{
    /**
     * Test creation an Date from array data.
     */
    public function testConstructor()
    {
        $string = '2017-03-29T12:18:00+03:00';
        $dateTime = new DateTime($string);
        $this->assertEquals($string, (string) $dateTime);
    }

    /**
     * Test SameValueAs method.
     */
    public function testSameValueAs()
    {
        $string = '2017-03-29T12:18:00+08:00';
        $dateTime = new DateTime($string);
        $notDateTime = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notDateTime ValueInterface */
        $this->assertFalse(
            $dateTime->sameValueAs($notDateTime),
            'Compared value object is not a DateTime object.'
        );

        $dateTimeNotSame = new DateTime('2017-03-30T12:34:56+01:00');
        $this->assertFalse(
            $dateTime->sameValueAs($dateTimeNotSame),
            'Sources do not share the same values.'
        );

        $dateTimeSame = new DateTime($string);
        $this->assertTrue(
            $dateTime->sameValueAs($dateTimeSame),
            'Sources share the same values.'
        );
    }

    /**
     * Test toString method.
     */
    public function testToString()
    {
        $string = '2017-03-29T12:18:00-05:00';

        $dateTime = new DateTime($string);
        $this->assertEquals(
            $string,
            (string) $dateTime,
            'String version of date = date in format "DATE_ATOM"'
        );
    }
}
