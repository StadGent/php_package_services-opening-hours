<?php

namespace StadGent\Services\Tests\OpeningHours;

use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Test;

class TestTest extends TestCase
{
    /**
     * Test the HelloWorld method.
     */
    public function testHelloWorld()
    {
        $test = new Test();
        $this->assertEquals(
            'Hello world!',
            $test->helloWorld()
        );
    }
}
