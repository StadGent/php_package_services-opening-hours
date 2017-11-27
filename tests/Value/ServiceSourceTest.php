<?php

namespace StadGent\Services\Test\OpeningHoursTest\Value;

use StadGent\Services\OpeningHours\Value\ServiceSource;
use StadGent\Services\OpeningHours\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class BooleanTest.
 *
 * @package Gent\Zalenzoeker\Tests\Value
 */
class ServiceSourceTest extends TestCase
{

    /**
     * Test from array with no source values in the array.
     */
    public function testFromEmptyArray()
    {
        $data = [];
        $source = ServiceSource::fromArray($data);

        $this->assertNull($source->getId());
        $this->assertNull($source->getName());
    }

    /**
     * Test from array containing values.
     */
    public function testFromArray()
    {
        $data = [
            'identifier' => '654-987-321',
            'source' => 'foobar',
        ];
        $source = ServiceSource::fromArray($data);

        $this->assertEquals($data['identifier'], $source->getId());
        $this->assertEquals($data['source'], $source->getName());
    }

    /**
     * Test same value as.
     */
    public function testSameValueAs()
    {
        $data = [
            'identifier' => '654-987-321',
            'source' => 'foobar',
        ];
        $source = ServiceSource::fromArray($data);
        $notSource = $this
            ->getMockBuilder(ValueInterface::class)
            ->getMock();
        /* @var $notSource ValueInterface */
        $this->assertFalse(
            $source->sameValueAs($notSource),
            'Compared value object is not a ServiceSource.'
        );

        $sourceNotSame = ServiceSource::fromArray(
            [
                'identifier' => 'abc-def-ghj',
                'source' => 'fizzbuzz',
            ]
        );
        $this->assertFalse(
            $source->sameValueAs($sourceNotSame),
            'Sources do not share the same values.'
        );

        $sourceSame = ServiceSource::fromArray($data);
        $this->assertTrue(
            $source->sameValueAs($sourceSame),
            'Sources share the same values.'
        );
    }

    /**
     * Test to string method.
     */
    public function testToString()
    {
        $source = ServiceSource::fromArray([]);
        $this->assertEquals('', (string) $source);

        $source = ServiceSource::fromArray(['source' => 'fooBar']);
        $this->assertEquals('fooBar', (string) $source);
    }
}
