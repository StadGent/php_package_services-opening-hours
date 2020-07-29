<?php

namespace StadGent\Services\Test\OpeningHours\Service\Service;

use StadGent\Services\OpeningHours\Exception\ServiceNotFoundException;
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
class ServiceServiceGetByOpenDataUriTest extends ServiceTestBase
{
    /**
     * Test the getByOpenDataUri return object.
     */
    public function testGetByOpenDataUri()
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);

        $serviceService = new ServiceService($client);
        $responseService = $serviceService->getByOpenDataUri('http://foo.bar/123');
        $this->assertSame($service, $responseService);
    }

    /**
     * Test the getByOpenDataUri return object from cache.
     */
    public function testGetByOpenDataUriFromCache()
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);
        $cache = $this->getFromCacheMock('OpeningHours:service:value:uri:http://foo.bar/123', $service);

        $serviceService = new ServiceService($client);
        $serviceService->setCacheService($cache);
        $responseService = $serviceService->getByOpenDataUri('http://foo.bar/123');
        $this->assertSame($service, $responseService);
    }

    /**
     * Test the getByOpenDataUri setCache return object without cache.
     */
    public function testGetByIdSetCache()
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);
        $cache = $this->getSetCacheMock('OpeningHours:service:value:uri:http://foo.bar/123', $service);

        $serviceService = new ServiceService($client);
        $serviceService->setCacheService($cache);
        $serviceService->getByOpenDataUri('http://foo.bar/123');
    }

    /**
     * Test the exception when the Open data URI does not exists.
     */
    public function testServiceNotFoundException()
    {
        $this->expectException(ServiceNotFoundException::class);
        $client = $this->getClientWithServiceNotFoundExceptionMock();
        $serviceService = new ServiceService($client);
        $serviceService->getByOpenDataUri('http://foo.bar/123');
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
        $expectedRequest = GetByOpenDataUriRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
