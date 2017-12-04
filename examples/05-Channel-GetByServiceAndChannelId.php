<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to get a singe Channel by the Service and Channel ID.
 */

require_once __DIR__ . '/bootstrap.php';


example_print_header('Example how to get a singe Channel by the Service and Channel ID.');




example_print_step('Create the API client configuration.');
$configuration = new \StadGent\Services\OpeningHours\Client\Configuration\Configuration($apiEndpoint);

example_print_step('Create the Guzzle client.');
$guzzleClient = new \GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new \StadGent\Services\OpeningHours\Client\Client($guzzleClient, $configuration);

example_print_step('Get the ChannelService.');
$channelService = \StadGent\Services\OpeningHours\ChannelServiceFactory::create($client);

example_print_step('Get the Channel by the Services & Channel ID');
example_print();

try {
    $channel = $channelService->getByServiceAndChannelId($service_id, $channel_id);
    example_print(sprintf(' Id         : %d', $channel->getId()));
    example_print(sprintf(' Label      : %s', $channel->getLabel()));
    example_print(sprintf(' Service ID : %d', $channel->getServiceId()));
} catch (\StadGent\Services\OpeningHours\Response\Exception\NotFoundException $e) {
    example_print(
        sprintf(
            'No Service found for Service ID : %d and Channel ID : %d',
            $service_id,
            $channel_id
        )
    );
} catch (\Exception $e) {
    example_print(sprintf('Error : %s', $e->getMessage()));
}




example_print_footer();
