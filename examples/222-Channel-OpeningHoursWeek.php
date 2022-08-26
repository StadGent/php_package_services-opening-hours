<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to get the OpeningHours object for a single week by the Service and Channel ID.
 *
 * @var string $apiEndpoint
 * @var string $apiKey
 * @var int|string $service_id
 * @var int|string $channel_id
 * @var string $openinghours_week_date
 */

use GuzzleHttp\Client as GuzzleClient;
use StadGent\Services\OpeningHours\Configuration\Configuration;
use StadGent\Services\OpeningHours\Client\Client;
use StadGent\Services\OpeningHours\ChannelOpeningHours;

require_once __DIR__ . '/bootstrap.php';

example_print_header(
    'Example how to get the OpeningHours object for a single week'
    . PHP_EOL
    . ' by the Service, Channel ID and week start date.'
);

example_print_step('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiKey);

example_print_step('Create the Guzzle client.');
$guzzleClient = new GuzzleClient(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

example_print_step('Get the ChannelService.');
$service = ChannelOpeningHours::create($client);

example_print_step('Get the OpeningHours by the Service, Channel ID & start date');
example_print();

try {
    $openingHours = $service->getWeek($service_id, $channel_id, $openinghours_week_date);
    example_sprintf(' Id      : %d', $openingHours->getChannelId());
    example_sprintf(' Label   : %s', $openingHours->getChannelLabel());
    example_print();
    example_print(' Days:');
    example_print();

    foreach ($openingHours->getDays() as $day) {
        /* @var $day \StadGent\Services\OpeningHours\Value\Day */
        example_sprintf('   Date    : %s', $day->getDate()->format('d/m/Y'));
        example_sprintf('   Is open : %d', (int) $day->isOpen());
        example_print('   Hours:');

        foreach ($day->getHours() as $hours) {
            example_sprintf('     %s > %s', $hours->getFromHour(), $hours->getUntilHour());
        }

        example_print();
    }
} catch (\StadGent\Services\OpeningHours\Exception\ServiceNotFoundException $e) {
    example_sprintf(' ! No Service found for Service ID : %d', $service_id);
} catch (\StadGent\Services\OpeningHours\Exception\ChannelNotFoundException $e) {
    example_sprintf(' ! No Channel found for Channel ID : %d', $channel_id);
} catch (\Exception $e) {
    example_sprintf(' ! Error : %s', $e->getMessage());
}

example_print_footer();
