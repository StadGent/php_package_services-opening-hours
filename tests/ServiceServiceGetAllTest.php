<?php

namespace StadGent\Services\Test\OpeningHours;

use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Request\Service\GetAllRequest;
use StadGent\Services\OpeningHours\Response\ServicesResponse;
use StadGent\Services\OpeningHours\ServiceService;
use StadGent\Services\OpeningHours\Value\ServiceCollection;

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

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ServiceService:getAll'))
            ->will($this->returnValue($serviceCollection));

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

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ServiceService:getAll'))
            ->will($this->returnValue(null));

        $cache
            ->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo('OpeningHours:ServiceService:getAll'),
                $this->equalTo($serviceCollection)
            );

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
