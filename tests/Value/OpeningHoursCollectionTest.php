<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\OpeningHoursCollection;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the OpeningHoursCollection value object.
 *
 * @package StadGent\Services\Test\OpeningHours\Value
 */
class OpeningHoursCollectionTest extends TestCase
{
    /**
     * Test with empty array.
     */
    public function testFromEmptyArray()
    {
        $collection = OpeningHoursCollection::fromArray([]);
        $this->assertEquals(0, $collection->getIterator()->count());
    }

    /**
     * Test with data in the array.
     */
    public function testFromArray()
    {
        $data = [
            [
                'channel' => 'FooBar',
                'channelId' => 1,
                'openingHours' => [],
            ],
            [
                'channel' => 'FizBuz',
                'channelId' => 5,
                'openingHours' => [],
            ],
        ];
        $collection = OpeningHoursCollection::fromArray($data);
        $this->assertEquals(2, $collection->getIterator()->count());
    }

    /**
     * Test comparing 2 equal collections.
     */
    public function testSameValueAs()
    {
        $data = [
            [
                'channel' => 'FooBar',
                'channelId' => 1,
                'openingHours' => [],
            ],
            [
                'channel' => 'FizBuz',
                'channelId' => 5,
                'openingHours' => [],
            ],
        ];

        $collection = OpeningHoursCollection::fromArray($data);
        $sameCollection = OpeningHoursCollection::fromArray($data);

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
                'channel' => 'FooBar',
                'channelId' => 1,
                'openingHours' => [],
            ],
            [
                'channel' => 'FizzBuzz',
                'channelId' => 5,
                'openingHours' => [],
            ],
        ];

        $collection = OpeningHoursCollection::fromArray($data);
        $this->assertEquals(
            'FooBar, FizzBuzz',
            (string) $collection,
            'String version contains channel labels separated by ", ".'
        );
    }
}
