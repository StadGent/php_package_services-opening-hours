<?php

/**
 * Config file containing the endpoint to connect to the webservice.
 */

// The API endpoint URL without the /service... part.
$apiEndpoint = '';


// Service Data to lookup data for --------------------------------------------

// Service label to search by.
$service_label = '';

// Service to load by its id.
// This id will also be used to lookup channels and opening hours.
$service_id = '';

// Service to load by its uri.
$service_uri = '';

// Service to load by its Vesta ID.
$service_vesta_id = '';





// Channel Data to lookup data for --------------------------------------------

// Channel to load by its id.
// This id will also be used to lookup channel opening hours.
$channel_id = '';





// Dates to lookup OpeningHours for -------------------------------------------

// Get the Opening Hours for a single day.
// The day date (in yyyy-mm-dd format) to get the data for.
$openinghours_day_date = '';

// Get the Opening Hours for a single week.
// A date (in yyyy-mm-dd format) in the week to get the data for.
$openinghours_week_date = '';

// Get the Opening Hours for a single month.
// A date (in yyyy-mm-dd format) in the month to get the data for.
$openinghours_month_date = '';

// Get the Opening Hours for a single year.
// A date (in yyyy-mm-dd format) in the year to get the data for.
$openinghours_year_date = '';

// Get the Opening Hours for a given period.
// The start date (in yyyy-mm-dd format) of the period to get the data for.
$openinghours_period_from = '';
// The end date (in yyyy-mm-dd format) of the period to get the data for.
$openinghours_period_until = '';
