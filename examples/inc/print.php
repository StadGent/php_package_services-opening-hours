<?php

/**
 * @file
 * Helper functions to print out messages to the command line interface.
 */

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