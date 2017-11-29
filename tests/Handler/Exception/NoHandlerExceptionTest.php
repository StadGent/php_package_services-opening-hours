<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Exception;

use StadGent\Services\OpeningHours\Handler\Exception\NoHandlerException;
use PHPUnit\Framework\TestCase;

/**
 * Tests NoHandlerException;
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Exception
 */
class NoHandlerExceptionTest extends TestCase
{
    /**
     * Test the message when exception is constructed from a given ClassName.
     */
    public function testFromClassName()
    {
        $exception = NoHandlerException::fromClassName('TestClassName');
        $this->assertEquals(
            'No handler found that supports request "TestClassName".',
            $exception->getMessage()
        );
    }
}
