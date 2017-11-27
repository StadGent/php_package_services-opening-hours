<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * ValueInterface.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
interface ValueInterface
{
    /**
     * Compare of another ValueObjectInterface has the exact same type.
     *
     * Checks if two value objects have the same class name.
     *
     * @param \StadGent\Services\OpeningHours\Value\ValueInterface $object
     *
     * @return bool
     */
    public function sameValueTypeAs(ValueInterface $object);

    /**
     * Compare two Value objects and tells whether they can be considered equal.
     *
     * @param \StadGent\Services\OpeningHours\Value\ValueInterface $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object);

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString();
}
