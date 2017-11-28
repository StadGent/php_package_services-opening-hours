<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * FromArrayInterface.
 *
 * Adds the required static method to create the value from an array of
 * properties.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
interface ValueFromArrayInterface
{
    /**
     * Returns a value object based on values extracted from the given array.
     *
     * @param array $data
     *   The data to create the value from.
     *
     * @return \StadGent\Services\OpeningHours\Value\ValueInterface
     */
    public static function fromArray(array $data);
}
