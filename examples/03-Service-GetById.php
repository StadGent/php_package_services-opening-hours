<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to get a list of all available Services.
 */

require_once __DIR__ . '/bootstrap.php';


example_print_header('Example how load a single Service by its id.');




example_print_step('Create the API client configuration.');
$configuration = new \StadGent\Services\OpeningHours\Client\Configuration\Configuration($apiEndpoint);

example_print_step('Create the Guzzle client.');
$guzzleClient = new \GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new \StadGent\Services\OpeningHours\Client\Client($guzzleClient, $configuration);

example_print_step('Get the ServiceService.');
$serviceService = \StadGent\Services\OpeningHours\ServiceServiceFactory::create($client);

example_print_step('Search Services GetById');
example_print();

try {
    $service = $serviceService->getById($service_id);
    example_print(sprintf(' Id       : %d', $service->getId()));
    example_print(sprintf(' Label    : %s', $service->getLabel()));
    example_print(sprintf(' Is Draft : %d', (int) $service->isDraft()));
} catch (\StadGent\Services\OpeningHours\Response\Exception\NotFoundException $e) {
    example_print(sprintf('No Service found for id : %d', $service_id));
} catch (\Exception $e) {
    example_print(sprintf('Error : %s', $e->getMessage()));
}




example_print_footer();
