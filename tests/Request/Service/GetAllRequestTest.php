<?php

namespace StadGent\Services\Test\OpeningHours\Request\Service;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\MethodType;
use StadGent\Services\OpeningHours\Request\Service\GetAllRequest;
use PHPUnit\Framework\TestCase;

/**
 * Test the GetAllRequest object.
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Service
 */

class GetAllRequestTest extends TestCase
{
    /**
     * Test if the method is GET.
     */
    public function testMethodIsGet()
    {
        $request = new GetAllRequest();
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * Test if the proper endpoint (URI) is set.
     */
    public function testEndpoint()
    {
        $request = new GetAllRequest();
        $this->assertEquals('services', $request->getRequestTarget());
    }

    /**
     * Test if the proper headers are set.
     */
    public function testHeaders()
    {
        $request = new GetAllRequest();
        $this->assertEquals(AcceptType::JSON, $request->getHeaderLine('Accept'));
    }
}
