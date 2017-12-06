<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response;

use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Value\OpeningHours;

/**
 * Tests the OpeningHoursResponse object.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response
 */
class OpeningHoursResponseTest extends TestCase
{
    /**
     * Test the Response object.
     */
    public function testOpeningHoursResponse()
    {
        $openingHours = OpeningHours::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openinghours' => [
                    '2022-04-01' => [
                        'date' => '2022-04-01',
                        'open' => false,
                        'hours' => [],
                    ],
                ],
            ]
        );

        $response = new OpeningHoursResponse($openingHours);
        $this->assertTrue($openingHours->sameValueAs($response->getOpeninghours()));
    }
}
