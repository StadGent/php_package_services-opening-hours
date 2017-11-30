<?php

namespace StadGent\Services\Test\OpeningHours;

use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Request\Service\GetByIdRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\ServiceService;
use StadGent\Services\OpeningHours\Value\Service;

/**
 * Tests for ServiceService::getById Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ServiceServiceGetByIdTest extends ServiceTestBase
{
    /**
     * Test the getById return object.
     */
    public function testGetById()
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);

        $serviceService = new ServiceService($client);
        $responseService = $serviceService->getById(10);
        $this->assertSame($service, $responseService);
    }

    /**
     * Test the getById return object from cache.
     */
    public function testGetByIdFromCache()
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ServiceService:getById:10'))
            ->will($this->returnValue($service));

        $serviceService = new ServiceService($client);
        $serviceService->setCacheService($cache);
        $responseService = $serviceService->getById(10);
        $this->assertSame($service, $responseService);
    }

    /**
     * Test the getAll setCache return object without cache.
     */
    public function testGetByIdSetCache()
    {
        $service = $this->createService();
        $client = $this->createClientForService($service);

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:ServiceService:getById:10'))
            ->will($this->returnValue(null));

        $cache
            ->expects($this->once())
            ->method('set')
            ->with($this->equalTo(
                'OpeningHours:ServiceService:getById:10'),
                $this->equalTo($service)
            );

        $serviceService = new ServiceService($client);
        $serviceService->setCacheService($cache);
        $serviceService->getById(10);
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
        $expectedRequest = GetByIdRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
