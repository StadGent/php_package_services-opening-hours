<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to get a list of all available Channels.
 *
 * @var string $apiEndpoint
 * @var string $apiKey
 * @var int|string $service_id
 */

use GuzzleHttp\Client as GuzzleClient;
use StadGent\Services\OpeningHours\Configuration\Configuration;
use StadGent\Services\OpeningHours\Client\Client;
use StadGent\Services\OpeningHours\Channel;

require_once __DIR__ . '/bootstrap.php';

example_print_header('Example how to get a list of all available Channels.');

example_print_step('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiKey);

example_print_step('Create the Guzzle client.');
$guzzleClient = new GuzzleClient(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

example_print_step('Get the ChannelService.');
$service = Channel::create($client);

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
