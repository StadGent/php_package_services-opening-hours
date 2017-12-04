<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Service;

use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\TestCase;

/**
 * Base class to test the Handlers.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class HandlerTestBase extends TestCase
{
    /**
     * Helper to create a response object.
     *
     * @param int $code
     *   The expected response code.
     * @param string $body
     *   The expected response body.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|ResponseInterface
     */
    protected function createResponseMock($code, $body)
    {
        $mock = $this
          ->getMockBuilder(ResponseInterface::class)
          ->disableOriginalConstructor()
          ->getMock();

        $mock
          ->expects($this->any())
          ->method('getStatusCode')
          ->will($this->returnValue($code));
        $mock
          ->expects($this->any())
          ->method('getBody')
          ->will($this->returnValue($body));

        return $mock;
    }
}
