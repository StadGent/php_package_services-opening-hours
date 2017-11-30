<?php

namespace StadGent\Services\Test\OpeningHours;

use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Client\ClientInterface;
use StadGent\Services\OpeningHours\Response\ResponseInterface;

/**
 * Base test class to test the Service classes.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ServiceTestBase extends TestCase
{
    /**
     * Helper to create a Client mock with given response.
     *
     * @param \StadGent\Services\OpeningHours\Response\ResponseInterface|null $response
     * @param \StadGent\Services\OpeningHours\Request\RequestInterface $expectedRequest
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|ClientInterface
     */
    protected function getClientMock(ResponseInterface $response, $expectedRequest = null)
    {
        $client = $this
          ->getMockBuilder(ClientInterface::class)
          ->disableOriginalConstructor()
          ->getMock();

        if ($expectedRequest) {
            $client
              ->expects($this->any())
              ->method('send')
              ->with($this->isInstanceOf($expectedRequest))
              ->will($this->returnValue($response));
        } else {
            $client
              ->expects($this->any())
              ->method('send')
              ->will($this->returnValue($response));
        }

        return $client;
    }

    /**
     * Helper to get a generic response mock.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|ResponseInterface
     */
    protected function getResponseDummyMock()
    {
        return $this
          ->getMockBuilder(ResponseInterface::class)
          ->disableOriginalConstructor()
          ->getMock();
    }
}
