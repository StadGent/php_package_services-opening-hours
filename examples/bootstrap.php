<?php

/**
 * Bootstrap file for all examples.
 */

// Error reporting.
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/Brussels');

// CLI only.
if (PHP_SAPI !== 'cli') {
    die('This example should only be run from a Command Line Interface.');
}

// Get the local config file.
require_once __DIR__ . '/config.php';

// AutoLoader to get all required libraries.
require_once __DIR__ . '/../vendor/autoload.php';




// HELPER functions -----------------------------------------------------------

/**
 * Helper to print text to CLI output.
 *
 * @param string $text
 *   (optional) The text to print.
 */
function example_print($text = '')
{
    echo $text, PHP_EOL;
}

/**
 * Helper to print a step output.
 *
 * @param string
 *   The step text.
 */
function example_print_step($text)
{
    example_print(' → ' . $text);
}


/**
 * Helper function to print a separator line.
 */
function example_print_separator()
{
    example_print(str_repeat('-', 80));
}

/**
 * Print the script header.
 *
 * @param string $title
 *   The script title.
 */
function example_print_header($title)
{
    example_print();
    example_print_separator();
    example_print($title);
    example_print_separator();
    example_print();
}

/**
 * Print the footer.
 */
function example_print_footer()
{
    example_print();
    example_print_separator();
    example_print();
}

