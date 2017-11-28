<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\HoursCollection;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the HoursCollection value object.
 *
 * @package Gent\Zalenzoeker\Tests\Value
 */
class HoursCollectionTest extends TestCase
{
    /**
     * Test with empty array.
     */
    public function testFromEmptyArray()
    {
        $collection = HoursCollection::fromArray([]);
        $this->assertEquals(0, $collection->getIterator()->count());
    }

    /**
     * Test with data in the array.
     */
    public function testFromArray()
    {
        $data = [
            [
                'from' => '10:00',
                'until' => '12:00',
            ],
            [
                'from' => '12:30',
                'until' => '18:00',
            ],
        ];
        $collection = HoursCollection::fromArray($data);
        $this->assertEquals(2, $collection->getIterator()->count());
    }

    /**
     * Test comparing 2 equal collections.
     */
    public function testSameValueAs()
    {
        $data = [
            [
                'from' => '10:00',
                'until' => '12:00',
            ],
            [
                'from' => '12:30',
                'until' => '18:00',
            ],
        ];

        $collection = HoursCollection::fromArray($data);
        $sameCollection = HoursCollection::fromArray($data);

        $this->assertTrue(
            $collection->sameValueAs($sameCollection),
            'Collections are the same.'
        );
    }

    /**
     * Test the method to get a string representing a collection.
     */
    public function testToString()
    {
        $data = [
            [
                'from' => '10:00',
                'until' => '12:00',
            ],
            [
                'from' => '12:30',
                'until' => '18:00',
            ],
        ];

        $collection = HoursCollection::fromArray($data);
        $this->assertEquals(
            '10:00 > 12:00, 12:30 > 18:00',
            (string) $collection,
            'String version contains hours "from > until" separated by ", ".'
        );
    }
}
