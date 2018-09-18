<?php

namespace StadGent\Services\Test\OpeningHours\Service\Service;

use StadGent\Services\OpeningHours\Request\Service\GetByOpenDataUriRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\Service\Service\ServiceService;
use StadGent\Services\OpeningHours\Value\Service;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

/**
 * Tests for ServiceService::getById Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 *
 * @covers \StadGent\Services\OpeningHours\Service\Service\ServiceService
 */
class ServiceServiceGetByVestaIdTest extends ServiceTestBase
{
    /**
     * Test if the proper URI is created by checking what cache key is created.
     */
    public function testGetByVestaId()
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);
        $cache = $this->getFromCacheMock('OpeningHours:service:value:uri:https://stad.gent/id/agents/123', $service);

        $serviceService = new ServiceService($client);
        $serviceService->setCacheService($cache);
        $responseService = $serviceService->getByVestaId('123');
        $this->assertSame($service, $responseService);
    }

    /**
     * Helper to create a service.
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     */
    protected function createService()
    {
        return Service::fromArray(
            [
                'id' => 10,
                'uri' => 'https://stad.gent/id/agents/123',
                'label' => 'FizzBazz label',
                'createdAt' => '2345-11-05T12:45:00+01:00',
                'updatedAt' => '2345-11-12T14:12:11+01:00',
            ]
        );
    }

    /**
     * Helper to create a client that will return the given service.
     *
     * @param \StadGent\Services\OpeningHours\Value\Service $service
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForService(Service $service)
    {
        $response = new ServiceResponse($service);
        $expectedRequest = GetByOpenDataUriRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
