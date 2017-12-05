<?php

namespace StadGent\Services\Test\OpeningHours\Exception;

use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use StadGent\Services\OpeningHours\Exception\ChannelNotFoundException;

/**
 * Tests ChannelNotFoundException.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response\Exception
 */
class ChannelNotFoundExceptionTest extends TestCase
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
        $exception = ChannelNotFoundException::fromException($exceptionMock);

        $this->assertEquals(404, $exception->getCode());
        $this->assertEquals(
            'The requested Channel was not found.',
            $exception->getMessage()
        );

        $this->assertSame($responseMock, $exception->getResponse());
    }
}
