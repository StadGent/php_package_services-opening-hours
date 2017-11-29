<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response;

use StadGent\Services\OpeningHours\Response\ServicesResponse;
use StadGent\Services\OpeningHours\Value\ServiceCollection;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the ServicesResponse object.
 *
 * @package StadGent\Services\Test\OpeningHours\Response
 */
class ServicesResponseTest extends TestCase
{
    /**
     * Test the Response object.
     */
    public function testServicesResponse()
    {
        $serviceCollection = ServiceCollection::fromArray(
            [
                [
                    'id' => 1,
                    'uri' => 'http://foo.bar/FizzBuzz',
                    'label' => 'FizzBuzz',
                    'created_at' => '2022-01-01T12:00:00+01:00',
                    'updated_at' => '2022-01-02T12:00:00+01:00',
                ],
            ]
        );

        $response = new ServicesResponse($serviceCollection);
        $this->assertTrue($serviceCollection->sameValueAs($response->getServices()));
    }
}
