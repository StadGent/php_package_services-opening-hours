<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response\Exception;

use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Response\Exception\ChannelNotFoundException;
use Psr\Http\Message\ResponseInterface;

/**
 * Tests NotFoundException.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response\Exception
 */
class ChannelNotFoundExceptionTest extends TestCase
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
            ->expects($this->once())
            ->method('getStatusCode')
            ->will($this->returnValue(404));

        /* @var $responseMock \Psr\Http\Message\ResponseInterface */
        $exception = ChannelNotFoundException::fromResponse($responseMock);

        $this->assertEquals(404, $exception->getCode());
        $this->assertEquals(
            'The requested Channel was not found.',
            $exception->getMessage()
        );

        $this->assertSame($responseMock, $exception->getResponse());
    }
}
