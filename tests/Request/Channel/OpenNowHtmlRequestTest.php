<?php

namespace StadGent\Services\Test\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowHtmlRequest;
use StadGent\Services\OpeningHours\Request\MethodType;
use PHPUnit\Framework\TestCase;

/**
 * Test the OpenNowHtmlRequest object.
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Service
 */
class OpenNowHtmlRequestTest extends TestCase
{
    /**
     * Test if the method is GET.
     */
    public function testMethodIsGet()
    {
        $request = new OpenNowHtmlRequest(1, 123);
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * Test if the proper endpoint (URI) is set.
     */
    public function testEndpoint()
    {
        $request = new OpenNowHtmlRequest(1, 123);
        $this->assertEquals('services/1/channels/123/open-now', $request->getRequestTarget());
    }

    /**
     * Test if the proper headers are set.
     */
    public function testHeaders()
    {
        $request = new OpenNowHtmlRequest(1, 123);
        $this->assertEquals(AcceptType::HTML, $request->getHeaderLine('Accept'));
    }
}
