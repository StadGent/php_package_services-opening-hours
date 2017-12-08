<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response;

use StadGent\Services\OpeningHours\Response\OpenNowResponse;
use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Value\OpenNow;

/**
 * Tests the OpenNowResponse object.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response
 */
class OpenNowResponseTest extends TestCase
{
    /**
     * Test the Response object.
     */
    public function testChannelResponse()
    {
        $openNow = OpenNow::fromArray(
            [
                'channel' => 'FizzBuzz',
                'channelId' => 123,
                'openNow' => [
                    'label' => 'open',
                    'status' => 'true',
                ],
            ]
        );

        $response = new OpenNowResponse($openNow);
        $this->assertTrue($openNow->sameValueAs($response->getOpenNow()));
    }
}
