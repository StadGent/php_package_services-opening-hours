<?php

namespace StadGent\Services\Test\OpeningHoursTest\Value;

use StadGent\Services\OpeningHours\Value\Boolean;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class BooleanTest.
 *
 * @package Gent\Zalenzoeker\Tests\Value
 */
class BooleanTest extends TestCase
{
    /**
     * Test the constructor.
     *
     * @param mixed $value
     *   The value to construct the boolean from.
     * @param bool $expected
     *   The expected casted value.
     *
     * @dataProvider booleanStatesProvider
     */
    public function testConstructor($value, $expected)
    {
        $boolean = new Boolean($value);
        $this->assertEquals($expected, $boolean->getAsBoolean());
    }

    /**
     * Test creating a True Boolean.
     */
    public function testTrue()
    {
        $boolean = Boolean::true();
        $this->assertTrue($boolean->getAsBoolean());
    }

    /**
     * Test creating a False Boolean.
     */
    public function testFalse()
    {
        $boolean = Boolean::false();
        $this->assertFalse($boolean->getAsBoolean());
    }

    /**
     * Test the isTrue() method.
     */
    public function testIsTrue()
    {
        $boolean = Boolean::true();
        $this->assertTrue($boolean->isTrue());

        $boolean = Boolean::false();
        $this->assertFalse($boolean->isTrue());
    }

    /**
     * Test the isFalse() method.
     */
    public function testIsFalse()
    {
        $boolean = Boolean::true();
        $this->assertFalse($boolean->isFalse());

        $boolean = Boolean::false();
        $this->assertTrue($boolean->isFalse());
    }

    /**
     * Test as integer.
     */
    public function testAsInteger()
    {
        $boolean = Boolean::false();
        $this->assertSame(0, $boolean->getAsInteger());

        $boolean = Boolean::true();
        $this->assertSame(1, $boolean->getAsInteger());
    }

    /**
     * Test as Yes/No.
     */
    public function testAsYesNo()
    {
        $boolean = Boolean::false();
        $this->assertSame('No', $boolean->getAsYesNo());

        $boolean = Boolean::true();
        $this->assertSame('Yes', $boolean->getAsYesNo());
    }

    /**
     * Test as Y/N.
     */
    public function testAsYN()
    {
        $boolean = Boolean::false();
        $this->assertSame('N', $boolean->getAsYN());

        $boolean = Boolean::true();
        $this->assertSame('Y', $boolean->getAsYN());
    }

    /**
     * Test same value as.
     */
    public function testSameValueAs()
    {
        $boolean = Boolean::true();
        $notBoolean = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notBoolean ValueInterface */
        $this->assertFalse(
            $boolean->sameValueAs($notBoolean),
            'Compared value object is not a Boolean.'
        );

        $booleanFalse = Boolean::false();
        $this->assertFalse(
            $boolean->sameValueAs($booleanFalse),
            'Booleans do not share the same state.'
        );

        $booleanTrue = Boolean::true();
        $this->assertTrue(
            $boolean->sameValueAs($booleanTrue),
            'Booleans share the same state.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $boolean = Boolean::false();
        $this->assertSame('N', (string) $boolean);

        $boolean = Boolean::true();
        $this->assertSame('Y', (string) $boolean);
    }

    /**
     * Data provider containing all supported values and their resulting state.
     *
     * @return array
     *   Array containing the input value and the expected casted value.
     */
    public function booleanStatesProvider()
    {
        return [
            [0, false],
            [1, true],
            ['0', false],
            ['1', true],
            ['n', false],
            ['y', true],
            ['N', false],
            ['Y', true],
            ['no', false],
            ['yes', true],
            ['NO', false],
            ['YES', true],
            ['No', false],
            ['Yes', true],
            [false, false],
            [true, true],
            ['', false],
            ['foobar', false],
            [[], false],
        ];
    }
}
