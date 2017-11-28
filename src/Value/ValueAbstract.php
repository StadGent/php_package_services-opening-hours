<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * ValueAbstract.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
abstract class ValueAbstract implements ValueInterface
{
    /**
     * @inheritdoc
     */
    public function sameValueTypeAs(ValueInterface $object)
    {
        return \get_class($this) === \get_class($object);
    }
}
