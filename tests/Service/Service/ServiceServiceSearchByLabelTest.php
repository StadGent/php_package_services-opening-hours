<?php

namespace StadGent\Services\Test\OpeningHours\Service\Service;

use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;
use StadGent\Services\OpeningHours\Response\ServicesResponse;
use StadGent\Services\OpeningHours\Service\Service\ServiceService;
use StadGent\Services\OpeningHours\Value\ServiceCollection;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

/**
 * Tests for ServiceService::searchByLabel method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ServiceServiceSearchByLabelTest extends ServiceTestBase
{
    /**
     * Test the getAll return object.
     */
    public function testGetAll()
    {
        $serviceCollection = $this->createServiceCollection();
        $client = $this->createClientForServiceCollection($serviceCollection);

        $serviceService = new ServiceService($client);
        $responseServiceCollection = $serviceService->searchByLabel('FooBar');
        $this->assertSame($serviceCollection, $responseServiceCollection);
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
        $serviceService->searchByLabel('FooBar');
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
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    protected function createClientForServiceCollection(ServiceCollection $serviceCollection)
    {
        $response = new ServicesResponse($serviceCollection);
        $expectedRequest = SearchByLabelRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
