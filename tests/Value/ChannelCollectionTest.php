<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use DigipolisGent\Value\ValueInterface;
use StadGent\Services\OpeningHours\Value\ChannelCollection;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the ChannelCollection value object.
 *
 * @package StadGent\Services\Test\OpeningHours\Value
 *
 * @covers \StadGent\Services\OpeningHours\Value\ChannelCollection
 */
class ChannelCollectionTest extends TestCase
{
    /**
     * Test with empty array.
     */
    public function testFromEmptyArray()
    {
        $collection = ChannelCollection::fromArray([]);
        $this->assertEquals(0, $collection->getIterator()->count());
    }

    /**
     * Test with data in the array.
     */
    public function testFromArray()
    {
        $data = [
            [
                'id' => 11,
                'label' => 'FooBar',
                'createdAt' => '2022-11-12T13:14:15+05:00',
                'updatedAt' => '2022-11-12T13:14:15+05:00',
            ],
            [
                'id' => 11,
                'label' => 'FizzBuzz',
                'createdAt' => '2023-11-12T13:14:15+05:00',
                'updatedAt' => '2023-11-12T13:14:15+05:00',
            ],
        ];
        $collection = ChannelCollection::fromArray($data);
        $this->assertEquals(2, $collection->getIterator()->count());
    }

    /**
     * Test the method to get a string representing a collection.
     */
    public function testToString()
    {
        $data = [
            [
                'id' => 11,
                'label' => 'FooBar',
                'createdAt' => '2022-11-12T13:14:15+05:00',
                'updatedAt' => '2022-11-12T13:14:15+05:00',
            ],
            [
                'id' => 12,
                'label' => 'FizzBuzz',
                'createdAt' => '2023-11-12T13:14:15+05:00',
                'updatedAt' => '2023-11-12T13:14:15+05:00',
            ],
        ];

        $expected = 'FooBar, FizzBuzz';

        $collection = ChannelCollection::fromArray($data);
        $this->assertEquals(
            $expected,
            (string) $collection,
            'String version contains names separated by ", ".'
        );
    }
}
