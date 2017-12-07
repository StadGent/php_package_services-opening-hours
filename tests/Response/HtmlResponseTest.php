<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response;

use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\OpeningHours\Response\HtmlResponse;
use StadGent\Services\OpeningHours\Value\Channel;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the HtmlResponse object.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response
 */
class HtmlResponseTest extends TestCase
{
    /**
     * Test the Response object.
     */
    public function testChannelResponse()
    {
        $html = '<div>Test me now</div>';
        $response = new HtmlResponse($html);
        $this->assertSame($html, $response->getHtml());
    }
}
