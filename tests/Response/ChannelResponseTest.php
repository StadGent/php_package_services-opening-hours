<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response;

use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\OpeningHours\Value\Channel;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the ChannelResponse object.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response
 */
class ChannelResponseTest extends TestCase
{
    /**
     * Test the Response object.
     */
    public function testChannelResponse()
    {
        $channel = Channel::fromArray(
            [
                'id' => 123,
                'label' => 'FizzBuzz',
                'serviceId' => 1,
                'createdAt' => '2022-01-01T12:00:00+01:00',
                'updatedAt' => '2022-01-02T12:00:00+01:00',
            ]
        );

        $response = new ChannelResponse($channel);
        $this->assertTrue($channel->sameValueAs($response->getChannel()));
    }
}
