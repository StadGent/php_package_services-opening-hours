<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Exception;

use Exception;

/**
 * Exception when the received response does not match what was expected.
 *
 * @package StadGent\Services\OpeningHours\Exception
 */
final class UnexpectedResponseException extends Exception
{
    /**
     * Generates exception with certain message
     *
     * @param string $actual
     *   The actual response class name.
     * @param string $expected
     *   The expected response class name.
     *
     * @return \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    public static function fromClass(string $actual, string $expected): UnexpectedResponseException
    {
        return new self(sprintf(
            'Got instance of %s expected %s response.',
            $actual,
            $expected
        ));
    }
}
