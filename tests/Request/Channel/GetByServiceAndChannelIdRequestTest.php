<?php

namespace StadGent\Services\Test\OpeningHours\Request\Service;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\Channel\GetByServiceAndChannelIdRequest;
use StadGent\Services\OpeningHours\Request\MethodType;
use PHPUnit\Framework\TestCase;

/**
 * Test the GetByIdRequest object.
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Service
 */
class GetByServiceAndChannelIdRequestTest extends TestCase
{
    /**
     * Test if the method is GET.
     */
    public function testMethodIsGet()
    {
        $request = new GetByServiceAndChannelIdRequest(1, 123);
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * Test if the proper endpoint (URI) is set.
     */
    public function testEndpoint()
    {
        $request = new GetByServiceAndChannelIdRequest(1, 123);
        $this->assertEquals('services/1/channels/123', $request->getRequestTarget());
    }

    /**
     * Test if the proper headers are set.
     */
    public function testHeaders()
    {
        $request = new GetByServiceAndChannelIdRequest(1, 123);
        $this->assertEquals(AcceptType::JSON, $request->getHeaderLine('Accept'));
    }
}
