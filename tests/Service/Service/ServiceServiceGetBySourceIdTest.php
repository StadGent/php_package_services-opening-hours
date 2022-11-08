<?php

declare(strict_types=1);

namespace StadGent\Services\Test\OpeningHours\Service\Service;

use StadGent\Services\OpeningHours\Exception\ServiceNotFoundException;
use StadGent\Services\OpeningHours\Request\Service\GetBySourceIdRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\Service\Service\ServiceService;
use StadGent\Services\OpeningHours\Value\Service;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

/**
 * Tests for ServiceService::getBySourceId Method.
 *
 * @covers \StadGent\Services\OpeningHours\Service\Service\ServiceService
 */
final class ServiceServiceGetBySourceIdTest extends ServiceTestBase
{
    /**
     * Loaded from service when not in cache.
     *
     * @test
     */
    public function itLoadsFromServiceWhenNotInCache(): void
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);

        $serviceService = new ServiceService($client);
        $responseService = $serviceService->getBySourceId('source_name', 'source_id');
        $this->assertSame($service, $responseService);
    }

    /**
     * Loaded from cache when available.
     *
     * @test
     */
    public function itReturnsServiceFromCacheWhenAvailable(): void
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);
        $cache = $this->getFromCacheMock('OpeningHours:service:value:sourceId:source_name:source_id', $service);

        $serviceService = new ServiceService($client);
        $serviceService->setCacheService($cache);
        $responseService = $serviceService->getBySourceId('source_name', 'source_id');
        $this->assertSame($service, $responseService);
    }

    /**
     * The item is stored in cache when loaded from service.
     *
     * @test
     */
    public function itCachesLoadedService(): void
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);
        $cache = $this->getSetCacheMock('OpeningHours:service:value:sourceId:source_name:source_id', $service);

        $serviceService = new ServiceService($client);
        $serviceService->setCacheService($cache);
        $serviceService->getBySourceId('source_name', 'source_id');
    }

    /**
     * Exception is thrown when no item could be found by the source id.
     *
     * @test
     */
    public function itThrowsNotFoundException(): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $client = $this->getClientWithServiceNotFoundExceptionMock();
        $serviceService = new ServiceService($client);
        $serviceService->getBySourceId('source_name', 'source_id');
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
                'uri' => 'http://foo.bar/123',
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
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    protected function createClientForService(Service $service)
    {
        $response = new ServiceResponse($service);
        $expectedRequest = GetBySourceIdRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
