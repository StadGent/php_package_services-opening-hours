<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to get the OpeningHours object for a given period by the Service
 * and Channel ID.
 */

require_once __DIR__ . '/bootstrap.php';


example_print_header(
    'Example how to get the OpeningHours object for a given period'
    . PHP_EOL
    . ' by the Service, Channel ID and period from-until dates.'
);




example_print_step('Create the API client configuration.');
$configuration = new \StadGent\Services\OpeningHours\Client\Configuration\Configuration($apiEndpoint);

example_print_step('Create the Guzzle client.');
$guzzleClient = new \GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new \StadGent\Services\OpeningHours\Client\Client($guzzleClient, $configuration);

example_print_step('Get the ChannelService.');
$channelService = \StadGent\Services\OpeningHours\ChannelServiceFactory::create($client);

example_print_step('Get the OpeningHours by the Service, Channel ID & period');
example_print();

try {
    $openingHours = $channelService->openingHoursPeriod(
        $service_id,
        $channel_id,
        $openinghours_period_from,
        $openinghours_period_until
    );
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
