<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueInterface;

/**
 * Interface adding the possibility to create the value object from array data.
 *
 * WARNING:
 * This is only here to support legacy code. Creating a value from array data
 * should be done using a normalizer.
 */
interface ValueFromArrayInterface
{
    /**
     * Returns a value object based on values extracted from the given array.
     *
     * @param array $data
     *   The data to create the value from.
     *
     * @return \DigipolisGent\Value\ValueInterface
     */
    public static function fromArray(array $data): ValueInterface;
}
