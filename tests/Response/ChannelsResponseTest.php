<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response;

use StadGent\Services\OpeningHours\Response\ChannelsResponse;
use StadGent\Services\OpeningHours\Value\ChannelCollection;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the ChannelsResponse object.
 *
 * @package StadGent\Services\Test\OpeningHours\Response
 */
class ChannelsResponseTest extends TestCase
{
    /**
     * Test the Response object.
     */
    public function testServicesResponse()
    {
        $channelsCollection = ChannelCollection::fromArray(
            [
                [
                    'id' => 57,
                    'label' => 'FizzBuzz',
                    'serviceId' => 1,
                    'createdAt' => '2022-01-01T12:00:00+01:00',
                    'updatedAt' => '2022-01-02T12:00:00+01:00',
                ],
            ]
        );

        $response = new ChannelsResponse($channelsCollection);
        $this->assertTrue($channelsCollection->sameValueAs($response->getChannels()));
    }
}
