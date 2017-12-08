<?php

namespace StadGent\Services\Test\OpeningHours\Exception;

use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use StadGent\Services\OpeningHours\Exception\ServiceNotFoundException;

/**
 * Tests ServiceNotFoundException.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response\Exception
 */
class ServiceNotFoundExceptionTest extends TestCase
{
    /**
     * Test the testFromException() method.
     */
    public function testFromException()
    {
        $responseMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $exceptionMock = $this
            ->getMockBuilder(RequestException::class)
            ->disableOriginalConstructor()
            ->getMock();
        $exceptionMock
            ->expects($this->once())
            ->method('getResponse')
            ->will($this->returnValue($responseMock));

        /* @var $exceptionMock RequestException */
        $exception = ServiceNotFoundException::fromException($exceptionMock);

        $this->assertEquals(404, $exception->getCode());
        $this->assertEquals(
            'The requested Service was not found.',
            $exception->getMessage()
        );

        $this->assertSame($responseMock, $exception->getResponse());
    }
}
