<?php

namespace StadGent\Services\Test\OpeningHours\Service\Service;

use StadGent\Services\OpeningHours\Request\Service\GetAllRequest;
use StadGent\Services\OpeningHours\Response\ServicesResponse;
use StadGent\Services\OpeningHours\Service\Service\ServiceService;
use StadGent\Services\OpeningHours\Value\ServiceCollection;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

/**
 * Tests for ServiceService::getAll method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ServiceServiceGetAllTest extends ServiceTestBase
{
    /**
     * Test the getAll return object.
     */
    public function testGetAll()
    {
        $serviceCollection = $this->createServiceCollection();
        $client = $this->createClientForServiceCollection($serviceCollection);

        $serviceService = new ServiceService($client);
        $responseServiceCollection = $serviceService->getAll();
        $this->assertSame($serviceCollection, $responseServiceCollection);
    }

    /**
     * Test the getAll return object from cache.
     */
    public function testGetAllFromCache()
    {
        $serviceCollection = $this->createServiceCollection();
        $client = $this->createClientForServiceCollection($serviceCollection);
        $cache = $this->getFromCacheMock('OpeningHours:service:value:all', $serviceCollection);

        $serviceService = new ServiceService($client);
        $serviceService->setCacheService($cache);
        $responseServiceCollection = $serviceService->getAll();
        $this->assertSame($serviceCollection, $responseServiceCollection);
    }

    /**
     * Test the getAll setCache return object without cache.
     */
    public function testGetAllSetCache()
    {
        $serviceCollection = $this->createServiceCollection();
        $client = $this->createClientForServiceCollection($serviceCollection);
        $cache = $this->getSetCacheMock('OpeningHours:service:value:all', $serviceCollection);

        $serviceService = new ServiceService($client);
        $serviceService->setCacheService($cache);
        $serviceService->getAll();
    }

    /**
     * Test the GetAll method UnexpectedResponseException.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    public function testUnexpectedResponseException()
    {
        $response = $this->getResponseDummyMock();
        $client = $this->getClientMock($response);
        $serviceService = new ServiceService($client);
        $serviceService->getAll();
    }

    /**
     * Helper to create the client response.
     *
     * @return \StadGent\Services\OpeningHours\Value\ServiceCollection
     */
    protected function createServiceCollection()
    {
        return ServiceCollection::fromArray([]);
    }

    /**
     * Helper to create a client that will return the given ServiceCollection.
     *
     * @param \StadGent\Services\OpeningHours\Value\ServiceCollection $serviceCollection
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForServiceCollection(ServiceCollection $serviceCollection)
    {
        $response = new ServicesResponse($serviceCollection);
        $expectedRequest = GetAllRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
