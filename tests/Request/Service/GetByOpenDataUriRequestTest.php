<?php

namespace StadGent\Services\Test\OpeningHours\Request\Service;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\MethodType;
use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Request\Service\GetByOpenDataUriRequest;

/**
 * Test the GetByIdRequest object.
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Service
 *
 * @covers \StadGent\Services\OpeningHours\Request\Service\GetByOpenDataUriRequest
 */
class GetByOpenDataUriRequestTest extends TestCase
{
    /**
     * Test if the method is GET.
     */
    public function testMethodIsGet()
    {
        $request = new GetByOpenDataUriRequest('http://foo.bar');
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * Test if the proper endpoint (URI) is set.
     */
    public function testEndpoint()
    {
        $request = new GetByOpenDataUriRequest('http://foo.bar');
        $this->assertEquals('services?uri=http://foo.bar', $request->getRequestTarget());
    }

    /**
     * Test if the proper headers are set.
     */
    public function testHeaders()
    {
        $request = new GetByOpenDataUriRequest('http://foo.bar');
        $this->assertEquals(AcceptType::JSON, $request->getHeaderLine('Accept'));
    }
}
