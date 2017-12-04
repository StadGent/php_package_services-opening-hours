<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to get a list of all available Channels.
 */

require_once __DIR__ . '/bootstrap.php';


example_print_header('Example how to get a list of all available Channels.');




example_print_step('Create the API client configuration.');
$configuration = new \StadGent\Services\OpeningHours\Client\Configuration\Configuration($apiEndpoint);

example_print_step('Create the Guzzle client.');
$guzzleClient = new \GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new \StadGent\Services\OpeningHours\Client\Client($guzzleClient, $configuration);

example_print_step('Get the ChannelService.');
$service = \StadGent\Services\OpeningHours\ChannelServiceFactory::create($client);

example_print_step('Get all Channels for a single service.');
$collection = $service->getAllByServiceId($service_id);

if ($collection->getIterator()->count()) {
    foreach ($collection as $item) {
        /* @var $item \StadGent\Services\OpeningHours\Value\Channel */
        example_print();
        example_print(sprintf(' Id         : %d', $item->getId()));
        example_print(sprintf(' Label      : %s', $item->getLabel()));
        example_print(sprintf(' Service Id : %d', $item->getServiceId()));
    }
} else {
    echo ' ! No Channels found.' . PHP_EOL;
}




example_print_footer();
