<?php

namespace StadGent\Services\Test\OpeningHours\Service\Response;

use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\Value\Service;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the ServiceResponse object.
 *
 * @package StadGent\Services\Test\OpeningHours\Service\Response
 */
class ServiceResponseTest extends TestCase
{
    /**
     * Test the Response object.
     */
    public function testServicesResponse()
    {
        $service = Service::fromArray(
            [
                'id' => 1,
                'uri' => 'http://foo.bar/FizzBuzz',
                'label' => 'FizzBuzz',
                'createdAt' => '2022-01-01T12:00:00+01:00',
                'updatedAt' => '2022-01-02T12:00:00+01:00',
            ]
        );

        $response = new ServiceResponse($service);
        $this->assertTrue($service->sameValueAs($response->getService()));
    }
}
