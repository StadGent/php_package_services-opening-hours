<?php

namespace StadGent\Services\OpeningHours\Exception;

class UnexpectedResponseException extends \Exception
{
    /**
     * Generates exception with certain message
     *
     * @param string $actual
     * @param string $expected
     * @return static
     */
    public static function fromClass($actual, $expected)
    {
        return new static(sprintf('Got instance of %s expected %s response.', $actual, $expected));
    }
}
