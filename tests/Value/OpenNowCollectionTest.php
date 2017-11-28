<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\OpenNowCollection;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the OpenNowCollection value object.
 *
 * @package StadGent\Services\Test\OpeningHours\Value
 */
class OpenNowCollectionTest extends TestCase
{
    /**
     * Test with empty array.
     */
    public function testFromEmptyArray()
    {
        $collection = OpenNowCollection::fromArray([]);
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
                'channelId' => 15,
                'openNow' => [
                    'status' => true,
                    'label' => 'open',
                ],
            ],
            [
                'channel' => 'FizzBuzz',
                'channelId' => 16,
                'openNow' => [
                    'status' => false,
                    'label' => 'closed',
                ],
            ],
        ];
        $collection = OpenNowCollection::fromArray($data);
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
                'channelId' => 15,
                'openNow' => [
                    'status' => true,
                    'label' => 'open',
                ],
            ],
            [
                'channel' => 'FizzBuzz',
                'channelId' => 16,
                'openNow' => [
                    'status' => false,
                    'label' => 'closed',
                ],
            ],
        ];

        $collection = OpenNowCollection::fromArray($data);
        $sameCollection = OpenNowCollection::fromArray($data);

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
                'channelId' => 15,
                'openNow' => [
                    'status' => true,
                    'label' => 'open',
                ],
            ],
            [
                'channel' => 'FizzBuzz',
                'channelId' => 16,
                'openNow' => [
                    'status' => false,
                    'label' => 'closed',
                ],
            ],
        ];

        $collection = OpenNowCollection::fromArray($data);
        $this->assertEquals(
            'FooBar, FizzBuzz',
            (string) $collection,
            'String version contains channel labels separated by ", ".'
        );
    }
}
