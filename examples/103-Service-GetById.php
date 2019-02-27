<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to load a single Service by its id.
 */

use GuzzleHttp\Client as GuzzleClient;
use StadGent\Services\OpeningHours\Configuration\Configuration;
use StadGent\Services\OpeningHours\Client\Client;
use StadGent\Services\OpeningHours\Service;

require_once __DIR__ . '/bootstrap.php';

example_print_header('Example how to load a single Service by its id.');

example_print_step('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiKey);

example_print_step('Create the Guzzle client.');
$guzzleClient = new GuzzleClient(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

example_print_step('Get the ServiceService.');
$service = Service::create($client);

example_print_step('Search Services GetById');
example_print();

try {
    $serviceItem = $service->getById($service_id);
    example_sprintf(' Id       : %d', $serviceItem->getId());
    example_sprintf(' Label    : %s', $serviceItem->getLabel());
    example_sprintf(' Is Draft : %d', (int) $serviceItem->isDraft());
} catch (\StadGent\Services\OpeningHours\Exception\ServiceNotFoundException $e) {
    example_sprintf(' ! No Service found for id : %d', $service_id);
} catch (\Exception $e) {
    example_sprintf(' ! Error : %s', $e->getMessage());
}

example_print_footer();
