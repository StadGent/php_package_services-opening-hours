<?php

namespace StadGent\Services\Test\OpeningHours\Value;

use StadGent\Services\OpeningHours\Value\ServiceCollection;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the ServiceCollection value object.
 *
 * @package StadGent\Services\Test\OpeningHours\Value
 */
class ServiceCollectionTest extends TestCase
{
    /**
     * Test with empty array.
     */
    public function testFromEmptyArray()
    {
        $collection = ServiceCollection::fromArray([]);
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
                'created_at' => '2022-11-12T13:14:15+05:00',
                'updated_at' => '2022-11-12T13:14:15+05:00',
            ],
            [
                'id' => 11,
                'label' => 'FizzBuzz',
                'created_at' => '2023-11-12T13:14:15+05:00',
                'updated_at' => '2023-11-12T13:14:15+05:00',
            ],
        ];
        $collection = ServiceCollection::fromArray($data);
        $this->assertEquals(2, $collection->getIterator()->count());
    }

    /**
     * Not the same value if the class is not the same.
     */
    public function testNotSameValueIfDifferentType()
    {
        $collection = ServiceCollection::fromArray([]);

        $notCollection = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();

        /* @var $notCollection ValueInterface */
        $this->assertFalse(
            $collection->sameValueAs($notCollection),
            'Collections are not the same if they are not of the same class.'
        );
    }

    /**
     * Not the same if not equal amount of items.
     */
    public function testNotSameValueIfDifferentCount()
    {
        $collection = ServiceCollection::fromArray(
            [
                [
                    'id' => 11,
                    'label' => 'FooBar',
                    'created_at' => '2022-11-12T13:14:15+05:00',
                    'updated_at' => '2022-11-12T13:14:15+05:00',
                ],
                [
                    'id' => 12,
                    'label' => 'FizzBuzz',
                    'created_at' => '2023-11-12T13:14:15+05:00',
                    'updated_at' => '2023-11-12T13:14:15+05:00',
                ],
            ]
        );

        $notSameCollection = ServiceCollection::fromArray(
            [
                [
                    'id' => 11,
                    'label' => 'FooBar',
                    'created_at' => '2022-11-12T13:14:15+05:00',
                    'updated_at' => '2022-11-12T13:14:15+05:00',
                ],
            ]
        );

        $this->assertFalse(
            $collection->sameValueAs($notSameCollection),
            'Collections must have equal amount of items.'
        );
    }

    /**
     * Not the same if not the same array keys.
     */
    public function testNotSameValueIfDifferentKeys()
    {
        $collection = ServiceCollection::fromArray(
            [
                [
                    'id' => 11,
                    'label' => 'FooBar',
                    'created_at' => '2022-11-12T13:14:15+05:00',
                    'updated_at' => '2022-11-12T13:14:15+05:00',
                ],
                [
                    'id' => 12,
                    'label' => 'FizzBuzz',
                    'created_at' => '2023-11-12T13:14:15+05:00',
                    'updated_at' => '2023-11-12T13:14:15+05:00',
                ],
            ]
        );

        $notSameCollection = ServiceCollection::fromArray(
            [
                3 => [
                    'id' => 12,
                    'label' => 'FizzBuzz',
                    'created_at' => '2023-11-12T13:14:15+05:00',
                    'updated_at' => '2023-11-12T13:14:15+05:00',
                ],
                4 => [
                    'id' => 11,
                    'label' => 'FooBar',
                    'created_at' => '2022-11-12T13:14:15+05:00',
                    'updated_at' => '2022-11-12T13:14:15+05:00',
                ],

            ]
        );

        $this->assertFalse(
            $collection->sameValueAs($notSameCollection),
            'Collections must have the same keys.'
        );
    }

    /**
     * Test comparing 2 equal collections.
     */
    public function testSameValueAs()
    {
        $data = [
            [
                'id' => 11,
                'label' => 'FooBar',
                'created_at' => '2022-11-12T13:14:15+05:00',
                'updated_at' => '2022-11-12T13:14:15+05:00',
            ],
            [
                'id' => 12,
                'label' => 'FizzBuzz',
                'created_at' => '2023-11-12T13:14:15+05:00',
                'updated_at' => '2023-11-12T13:14:15+05:00',
            ],
        ];

        $collection = ServiceCollection::fromArray($data);
        $sameCollection = ServiceCollection::fromArray($data);

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
                'id' => 11,
                'label' => 'FooBar',
                'created_at' => '2022-11-12T13:14:15+05:00',
                'updated_at' => '2022-11-12T13:14:15+05:00',
            ],
            [
                'id' => 12,
                'label' => 'FizzBuzz',
                'created_at' => '2023-11-12T13:14:15+05:00',
                'updated_at' => '2023-11-12T13:14:15+05:00',
            ],
        ];

        $expected = 'FooBar, FizzBuzz';

        $collection = ServiceCollection::fromArray($data);
        $this->assertEquals(
            $expected,
            (string) $collection,
            'String version contains names separated by ", ".'
        );
    }
}
