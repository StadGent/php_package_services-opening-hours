<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\DayCollection;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the DaysCollection value object.
 *
 * @package StadGent\Services\Test\OpeningHours\Value
 *
 * @covers \StadGent\Services\OpeningHours\Value\DayCollection
 */
class DayCollectionTest extends TestCase
{
    /**
     * Test with empty array.
     */
    public function testFromEmptyArray()
    {
        $collection = DayCollection::fromArray([]);
        $this->assertEquals(0, $collection->getIterator()->count());
    }

    /**
     * Test with data in the array.
     */
    public function testFromArray()
    {
        $data = [
            [
                'date' => '2020-03-01',
                'isOpen' => false,
                'hours' => [],
            ],
            [
                'date' => '2020-03-02',
                'isOpen' => true,
                'hours' => [
                    [
                        'from' => '10:00',
                        'until' => '18:00'
                    ],
                ],
            ],
        ];
        $collection = DayCollection::fromArray($data);
        $this->assertEquals(2, $collection->getIterator()->count());
    }

    /**
     * Test the method to get a string representing a collection.
     */
    public function testToString()
    {
        $data = [
            [
                'date' => '2020-03-01',
            ],
            [
                'date' => '2020-03-02',
            ],
            [
                'date' => '2020-03-03',
            ],
        ];

        $collection = DayCollection::fromArray($data);
        $this->assertEquals(
            '2020-03-01, 2020-03-02, 2020-03-03',
            (string) $collection,
            'String version contains dates ", ".'
        );
    }
}
