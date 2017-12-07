<?php

namespace StadGent\Services\Test\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodHtmlRequest;
use StadGent\Services\OpeningHours\Request\MethodType;
use PHPUnit\Framework\TestCase;

/**
 * Test the OpeningHoursPeriodHtmlRequest object.
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Service
 */
class OpeningHoursPeriodHtmlRequestTest extends TestCase
{
    /**
     * Test if the method is GET.
     */
    public function testMethodIsGet()
    {
        $request = new OpeningHoursPeriodHtmlRequest(1, 123, '2020-01-02', '2020-02-28');
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * Test if the proper endpoint (URI) is set.
     */
    public function testEndpoint()
    {
        $request = new OpeningHoursPeriodHtmlRequest(1, 123, '2020-01-02', '2020-02-28');
        $this->assertEquals(
            'services/1/channels/123/openinghours?from=2020-01-02&until=2020-02-28',
            $request->getRequestTarget()
        );
    }

    /**
     * Test if the proper headers are set.
     */
    public function testHeaders()
    {
        $request = new OpeningHoursPeriodHtmlRequest(1, 123, '2020-01-02', '2020-02-28');
        $this->assertEquals(AcceptType::HTML, $request->getHeaderLine('Accept'));
    }
}
