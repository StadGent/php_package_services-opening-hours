<?php

namespace StadGent\Services\Test\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\MethodType;
use StadGent\Services\OpeningHours\Request\Channel\GetAllRequest;
use PHPUnit\Framework\TestCase;

/**
 * Test the GetAllRequest object.
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Channel
 */

class GetAllRequestTest extends TestCase
{
    /**
     * Test if the method is GET.
     */
    public function testMethodIsGet()
    {
        $request = new GetAllRequest(123);
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * Test if the proper endpoint (URI) is set.
     */
    public function testEndpoint()
    {
        $request = new GetAllRequest(123);
        $this->assertEquals('services/123/channels', $request->getRequestTarget());
    }

    /**
     * Test if the proper headers are set.
     */
    public function testHeaders()
    {
        $request = new GetAllRequest(123);
        $this->assertEquals(AcceptType::JSON, $request->getHeaderLine('Accept'));
    }
}
