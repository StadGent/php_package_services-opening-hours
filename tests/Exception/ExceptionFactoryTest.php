<?php

namespace StadGent\Services\Test\OpeningHours\Exception;

use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use StadGent\Services\OpeningHours\Exception\ChannelNotFoundException;
use StadGent\Services\OpeningHours\Exception\ExceptionFactory;
use StadGent\Services\OpeningHours\Exception\NotFoundException;
use StadGent\Services\OpeningHours\Exception\ServiceNotFoundException;

/**
 * Tests the ExceptionFactory.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response\Exception
 */
class ExceptionFactoryTest extends TestCase
{
    /**
     * Test the fromException() method with a non RequestException.
     */
    public function testFromNonRequestException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Test me now.');
        $e = new Exception('Test me now.');
        ExceptionFactory::fromException($e);
    }

    /**
     * Test if the exception is returned if no special one.
     */
    public function testFromFallbackResponseException()
    {
        $this->expectException(RequestException::class);
        $this->expectExceptionCode(9999);
        $this->expectExceptionMessage('FooBar');
        $requestMock = $this
            ->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $responseMock = $this
            ->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();
        $responseMock
            ->expects($this->once())
            ->method('getStatusCode')
            ->will($this->returnValue(9999));

        $exceptionMock = new RequestException(
            'FooBar',
            $requestMock,
            $responseMock
        );

        ExceptionFactory::fromException($exceptionMock);
    }

    /**
     * Test the NotFoundException when the response body has no error target.
     */
    public function testFromServiceResponseWithoutTargetException()
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionCode(404);
        $exceptionMock = $this->createExceptionMock(404, '{}');
        ExceptionFactory::fromException($exceptionMock);
    }

    /**
     * Test the fromException() method with a 404 RequestException (Service).
     *
     * We don't check the exception using annotations as we want to validate
     * getting the response object within.
     */
    public function testFromServiceResponse404Exception()
    {
        $exceptionMock = $this->createExceptionMock(
            404,
            $this->getServiceNotFoundBody()
        );

        try {
            ExceptionFactory::fromException($exceptionMock);
        } catch (Exception $exception) {
            // No catch specific code.
        }

        $this->assertInstanceOf(ServiceNotFoundException::class, $exception);
        $this->assertSame(404, $exception->getCode());
        $this->assertSame($exceptionMock->getResponse(), $exception->getResponse());
    }

    /**
     * Test the fromException() method with a 422 RequestException (Service).
     *
     * We don't check the exception using annotations as we want to validate
     * getting the response object within.
     */
    public function testFromServiceResponse422Exception()
    {
        $exceptionMock = $this->createExceptionMock(
            422,
            $this->getServiceNotFoundBody()
        );

        try {
            ExceptionFactory::fromException($exceptionMock);
        } catch (Exception $exception) {
            // No catch specific code.
        }

        $this->assertInstanceOf(ServiceNotFoundException::class, $exception);
        $this->assertSame(404, $exception->getCode());
        $this->assertSame($exceptionMock->getResponse(), $exception->getResponse());
    }

    /**
     * Test the fromException() method with a 404 RequestException (Channel).
     *
     * We don't check the exception using annotations as we want to validate
     * getting the response object within.
     */
    public function testFromChannelResponse404Exception()
    {
        $exceptionMock = $this->createExceptionMock(
            404,
            $this->getChannelNotFoundBody()
        );

        try {
            ExceptionFactory::fromException($exceptionMock);
        } catch (Exception $exception) {
            // No catch specific code.
        }

        $this->assertInstanceOf(ChannelNotFoundException::class, $exception);
        $this->assertSame(404, $exception->getCode());
        $this->assertSame($exceptionMock->getResponse(), $exception->getResponse());
    }

    /**
     * Test the fromException() method with a 422 RequestException (Channel).
     *
     * We don't check the exception using annotations as we want to validate
     * getting the response object within.
     */
    public function testFromChannelResponse422Exception()
    {
        $exceptionMock = $this->createExceptionMock(
            422,
            $this->getChannelNotFoundBody()
        );

        try {
            ExceptionFactory::fromException($exceptionMock);
        } catch (Exception $exception) {
            // No catch specific code.
        }

        $this->assertInstanceOf(ChannelNotFoundException::class, $exception);
        $this->assertSame(404, $exception->getCode());
        $this->assertSame($exceptionMock->getResponse(), $exception->getResponse());
    }

    /**
     * Test the fromException() method with a 422 RequestException (Other).
     *
     * We don't check the exception using annotations as we want to validate
     * getting the response object within.
     */
    public function testFromOtherResponse422Exception()
    {
        $exceptionMock = $this->createExceptionMock(
            404,
            $this->getItemNotFoundBody()
        );

        try {
            ExceptionFactory::fromException($exceptionMock);
        } catch (Exception $exception) {
            // No catch specific code.
        }

        $this->assertInstanceOf(NotFoundException::class, $exception);
        $this->assertSame(404, $exception->getCode());
        $this->assertSame($exceptionMock->getResponse(), $exception->getResponse());
    }

    /**
     * Helper to create an ExceptionMock.
     *
     * @param int $code
     *   The exception code.
     * @param string $responseBody
     *   The response body.
     *
     * @return \GuzzleHttp\Exception\RequestException
     *   The exception.
     */
    protected function createExceptionMock($code, $responseBody)
    {
        $streamMock = $this
            ->getMockBuilder(Stream::class)
            ->disableOriginalConstructor()
            ->getMock();
        $streamMock
            ->expects($this->once())
            ->method('getContents')
            ->will($this->returnValue($responseBody));

        $requestMock = $this
            ->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $responseMock = $this
            ->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();
        $responseMock
            ->expects($this->once())
            ->method('getStatusCode')
            ->will($this->returnValue($code));
        $responseMock
            ->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($streamMock));

        $exceptionMock = new RequestException(
            'FooBar',
            $requestMock,
            $responseMock
        );

        return $exceptionMock;
    }

    /**
     * Get Service not found body.
     *
     * @return string
     */
    protected function getServiceNotFoundBody()
    {
        return <<<EOT
{
    "error": {
        "code": "ModelNotFoundException",
        "message": "Service model is not found with given identifier",
        "target": "Service"
    }
}
EOT;
    }

    /**
     * Get Channel not found body.
     *
     * @return string
     */
    protected function getChannelNotFoundBody()
    {
        return <<<EOT
{
    "error": {
        "code": "ModelNotFoundException",
        "message": "Channel model is not found with given identifier",
        "target": "Channel"
    }
}
EOT;
    }

    /**
     * Get Channel not found body.
     *
     * @return string
     */
    protected function getItemNotFoundBody()
    {
        return <<<EOT
{
    "error": {
        "code": "ModelNotFoundException",
        "message": "FooBar model is not found with given identifier",
        "target": "FooBar"
    }
}
EOT;
    }
}
