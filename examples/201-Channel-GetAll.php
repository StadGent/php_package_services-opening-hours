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
example_print();

try {
    $collection = $service->getAll($service_id);

    if ($collection->getIterator()->count()) {
        foreach ($collection as $item) {
            /* @var $item \StadGent\Services\OpeningHours\Value\Channel */
            example_sprintf(' Id         : %d', $item->getId());
            example_sprintf(' Label      : %s', $item->getLabel());
            example_sprintf(' Service Id : %d', $item->getServiceId());
            example_print();
        }
    } else {
        example_print(' ! No Channels found.');
    }
} catch (\StadGent\Services\OpeningHours\Exception\ServiceNotFoundException $e) {
    example_sprintf(' ! No Service found for id : %d', $service_id);
} catch (\Exception $e) {
    example_sprintf(' ! Error : %s', $e->getMessage());
}




example_print_footer();
