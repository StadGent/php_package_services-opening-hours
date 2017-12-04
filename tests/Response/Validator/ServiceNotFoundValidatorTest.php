<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response\Exception;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use StadGent\Services\OpeningHours\Response\Validator\ServiceNotFoundValidator;

/**
 * Tests NotFoundException.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response\Exception
 */
class ServiceNotFoundValidatorTest extends TestCase
{
    /**
     * The validator throws ServiceNotFoundException when status code = 404.
     *
     * @expectedException \StadGent\Services\OpeningHours\Response\Exception\ServiceNotFoundException
     */
    public function testFromResponseWithStatusCode404()
    {
        /* @var $responseMock \Psr\Http\Message\ResponseInterface */
        $responseMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $responseMock
            ->expects($this->exactly(2))
            ->method('getStatusCode')
            ->will($this->returnValue(404));

        $validator = new ServiceNotFoundValidator();
        $validator->validate($responseMock);
    }

    /**
     * The validator throws ServiceNotFoundException when status code = 422.
     *
     * @expectedException \StadGent\Services\OpeningHours\Response\Exception\ServiceNotFoundException
     *
     * @TODO: The 422 is temporary until the wrong return code from the API is
     *        fixed.
     */
    public function testFromResponseWithStatusCode422()
    {
        /* @var $responseMock \Psr\Http\Message\ResponseInterface */
        $responseMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $responseMock
            ->expects($this->exactly(2))
            ->method('getStatusCode')
            ->will($this->returnValue(422));

        $validator = new ServiceNotFoundValidator();
        $validator->validate($responseMock);
    }
}
