<?php

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\CollectionAbstract;
use DigipolisGent\Value\ValueFromArrayInterface;

/**
 * Object describing a collection of OpeningHours.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class OpeningHoursCollection extends CollectionAbstract implements ValueFromArrayInterface
{
    /**
     * Use only the named constructors.
     */
    protected function __construct()
    {
        // The constructor is protected:
        // Create the object using the named constructors.
    }

    /**
     * Create a Collection of OpeningHours objects from an array of data.
     *
     * The array may contain a set of OpeningHours array data.
     * @see \StadGent\Services\OpeningHours\Value\OpeningHours.
     *
     * @param array $data
     *   Array of OpeningHours data.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpeningHoursCollection
     *
     * @throws \InvalidArgumentException
     *   If one of the items does not have a date.
     */
    public static function fromArray(array $data)
    {
        $collection = new self();

        foreach ($data as $key => $item) {
            $collection->values[$key] = OpeningHours::fromArray($item);
        }

        return $collection;
    }

    /**
     * @inheritdoc
     *
     * Will return the channel names separated by ", ":
     * General, First line, Second line
     */
    public function __toString()
    {
        $labels = [];
        foreach ($this->values as $value) {
            /* @var $value \StadGent\Services\OpeningHours\Value\OpeningHours */
            $labels[] = (string) $value;
        }

        return (string) implode(', ', $labels);
    }
}
