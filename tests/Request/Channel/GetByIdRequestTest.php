<?php

namespace StadGent\Services\Test\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\Channel\GetByIdRequest;
use StadGent\Services\OpeningHours\Request\MethodType;
use PHPUnit\Framework\TestCase;

/**
 * Test the GetByIdRequest object.
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Service
 */
class GetByIdRequestTest extends TestCase
{
    /**
     * Test if the method is GET.
     */
    public function testMethodIsGet()
    {
        $request = new GetByIdRequest(1, 123);
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * Test if the proper endpoint (URI) is set.
     */
    public function testEndpoint()
    {
        $request = new GetByIdRequest(1, 123);
        $this->assertEquals('services/1/channels/123', $request->getRequestTarget());
    }

    /**
     * Test if the proper headers are set.
     */
    public function testHeaders()
    {
        $request = new GetByIdRequest(1, 123);
        $this->assertEquals(AcceptType::JSON, $request->getHeaderLine('Accept'));
    }
}
