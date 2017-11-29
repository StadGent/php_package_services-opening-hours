<?php

namespace StadGent\Services\Test\OpeningHours\Exception;

use StadGent\Services\OpeningHours\Exception\UnexpectedResponseException;
use PHPUnit\Framework\TestCase;

/**
 * Tests NoHandlerException;
 *
 * @package Gent\Zalenzoeker\Tests\Client\Handler
 */
class UnexpectedResponseExceptionTest extends TestCase
{
    /**
     * Test creating the exception from the actual vs expected class name.
     */
    public function testFromClass()
    {
        $exception = UnexpectedResponseException::fromClass('ActualClass', 'ExpectedClass');
        $this->assertEquals(
          'Got instance of ActualClass expected ExpectedClass response.',
          $exception->getMessage()
        );
    }
}
