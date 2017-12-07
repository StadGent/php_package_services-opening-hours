<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHtmlHandler;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowHtmlRequest;
use StadGent\Services\OpeningHours\Response\HtmlResponse;
use StadGent\Services\Test\OpeningHours\Handler\HandlerTestBase;

/**
 * Test the OpenNowHtmlHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class OpenNowHtmlHandlerTest extends HandlerTestBase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new OpenNowHtmlHandler();
        $this->assertEquals(
            [OpenNowHtmlRequest::class],
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Channel\OpenNowRequest.'
        );
    }

    /**
     * Test the toResponse method with returned data.
     */
    public function testToResponseWithData()
    {
        $body = <<<EOT
<div vocab="http://schema.org/" typeof="Library">
    <h1>FooBar</h1>
    <div>open</div>
</div>
EOT;
        $openNowResponse = $this->createResponseMock(200, $body);

        $handler = new OpenNowHtmlHandler();
        $response = $handler->toResponse($openNowResponse);

        $this->assertInstanceOf(
            HtmlResponse::class,
            $response,
            'Response should be a \StadGent\Services\OpeningHours\Response\HtmlResponse object.'
        );
    }
}
