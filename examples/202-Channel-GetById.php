<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to get a singe Channel by the Service and Channel ID.
 */

require_once __DIR__ . '/bootstrap.php';


example_print_header('Example how to get a singe Channel by the Service and Channel ID.');




example_print_step('Create the API client configuration.');
$configuration = new \StadGent\Services\OpeningHours\Configuration\Configuration($apiEndpoint);

example_print_step('Create the Guzzle client.');
$guzzleClient = new \GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new \StadGent\Services\OpeningHours\Client\Client($guzzleClient, $configuration);

example_print_step('Get the ChannelService.');
$service = \StadGent\Services\OpeningHours\Channel::create($client);

example_print_step('Get the Channel by the Services & Channel ID');
example_print();

try {
    $channel = $service->getById($service_id, $channel_id);
    example_sprintf(' Id         : %d', $channel->getId());
    example_sprintf(' Label      : %s', $channel->getLabel());
    example_sprintf(' Service ID : %d', $channel->getServiceId());
} catch (\StadGent\Services\OpeningHours\Exception\ServiceNotFoundException $e) {
    example_sprintf(' ! No Service found for Service ID : %d', $service_id);
} catch (\StadGent\Services\OpeningHours\Exception\ChannelNotFoundException $e) {
    example_sprintf(' ! No Channel found for Channel ID : %d', $channel_id);
} catch (\Exception $e) {
    example_sprintf(' ! Error : %s', $e->getMessage());
}




example_print_footer();
