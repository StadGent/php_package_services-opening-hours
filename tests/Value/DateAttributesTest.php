<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\DateAttributes;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Tests the DateAttributes value object.
 *
 * @package Gent\Zalenzoeker\Tests\Value
 */
class DateAttributesTest extends TestCase
{

    /**
     * Test exception when no created_at value in the array.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The array should contain a "created_at" value.
     */
    public function testExceptionWhenNoCreatedAtInArray()
    {
        $data = [];
        DateAttributes::fromArray($data);
    }

    /**
     * Test exception when no updated_at value in the array.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The array should contain an "updated_at" value.
     */
    public function testExceptionWhenNoUpdatedAtInArray()
    {
        $data = [
            'created_at' => '2123-12-24T12:13:14+01:00'
        ];
        DateAttributes::fromArray($data);
    }

    /**
     * Test from array containing values.
     */
    public function testFromArray()
    {
        $data = [
            'created_at' => '2123-12-24 12:13:14',
            'updated_at' => '2123-12-25 13:14:15',
        ];
        $dateAttributes = DateAttributes::fromArray($data);

        $this->assertEquals(
            $data['created_at'],
            $dateAttributes->getCreatedAt()->format('Y-m-d H:i:s')
        );
        $this->assertEquals(
            $data['updated_at'],
            $dateAttributes->getUpdatedAt()->format('Y-m-d H:i:s')
        );
    }

    /**
     * Test same value as.
     */
    public function testSameValueAs()
    {
        $data = [
            'created_at' => '2123-12-24 12:13:14',
            'updated_at' => '2123-12-25 13:14:15',
        ];
        $dateAttributes = DateAttributes::fromArray($data);
        $notDateAttributes = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notSource ValueInterface */
        $this->assertFalse(
            $dateAttributes->sameValueAs($notDateAttributes),
            'Compared value object is not a ServiceSource.'
        );

        $dateAttributesNotSame = DateAttributes::fromArray(
            [
                'created_at' => '2103-12-24 12:13:14',
                'updated_at' => '2103-12-25 13:14:15',
            ]
        );
        $this->assertFalse(
            $dateAttributes->sameValueAs($dateAttributesNotSame),
            'Sources do not share the same values.'
        );

        $dateAttributesSame = DateAttributes::fromArray($data);
        $this->assertTrue(
            $dateAttributes->sameValueAs($dateAttributesSame),
            'Sources share the same values.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $dateAttributes = DateAttributes::fromArray(
            [
                'created_at' => '2103-12-24 12:13:14',
                'updated_at' => '2103-12-25 13:14:15',
            ]
        );
        $this->assertEquals('2103-12-24T12:13:14+01:00', (string) $dateAttributes);
    }
}
