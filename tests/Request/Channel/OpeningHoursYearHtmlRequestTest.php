<?php

namespace StadGent\Services\Test\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearHtmlRequest;
use StadGent\Services\OpeningHours\Request\MethodType;
use PHPUnit\Framework\TestCase;

/**
 * Test the OpeningHoursYearHtmlRequest object.
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Service
 */
class OpeningHoursYearHtmlRequestTest extends TestCase
{
    /**
     * Test if the method is GET.
     */
    public function testMethodIsGet()
    {
        $request = new OpeningHoursYearHtmlRequest(1, 123, '2020-01-02');
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * Test if the proper endpoint (URI) is set.
     */
    public function testEndpoint()
    {
        $request = new OpeningHoursYearHtmlRequest(1, 123, '2020-01-02');
        $this->assertEquals(
            'services/1/channels/123/openinghours/year?date=2020-01-02',
            $request->getRequestTarget()
        );
    }

    /**
     * Test if the proper headers are set.
     */
    public function testHeaders()
    {
        $request = new OpeningHoursYearHtmlRequest(1, 123, '2020-01-02');
        $this->assertEquals(AcceptType::HTML, $request->getHeaderLine('Accept'));
    }
}
