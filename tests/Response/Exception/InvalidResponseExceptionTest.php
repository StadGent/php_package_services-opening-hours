<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response\Exception;

use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Response\Exception\InvalidResponseException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class InvalidResponseExceptionTest
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response\Exception
 */
class InvalidResponseExceptionTest extends TestCase
{
    /**
     * Test the fromResponse method.
     */
    public function testFromResponse()
    {
        $responseMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $responseMock
            ->expects($this->exactly(2))
            ->method('getStatusCode')
            ->will($this->returnValue(123));

        /* @var $responseMock \Psr\Http\Message\ResponseInterface */
        $exception = InvalidResponseException::fromResponse($responseMock);

        $this->assertEquals(123, $exception->getCode());
        $this->assertEquals(
            'Response with status code 123 was unexpected.',
            $exception->getMessage()
        );

        $this->assertSame($responseMock, $exception->getResponse());
    }
}
