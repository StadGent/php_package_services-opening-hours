<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Object describing a collection of Days.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class DayCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     * Create a Collection of Day objects from an array of data.
     *
     * The array may contain a set of Day array data keyed by the day date.
     * @see \StadGent\Services\OpeningHours\Value\Day.
     *
     * @param array
     *   Array of days data.
     *
     * @returns \StadGent\Services\OpeningHours\Value\DayCollection
     *
     * @throws \InvalidArgumentException
     *   If one of the items does not have a date.
     */
    public static function fromArray(array $data)
    {
        $collection = new static();

        foreach ($data as $key => $item) {
            $collection->values[$key] = Day::fromArray($item);
        }

        return $collection;
    }

    /**
     * @inheritdoc
     *
     * Will return the days separated by ", ":
     * 2020-02-01, 2020-02-02, 2020-02-03
     */
    public function __toString()
    {
        $labels = [];
        foreach ($this->values as $value) {
            /* @var $value \StadGent\Services\OpeningHours\Value\Day */
            $labels[] = (string) $value;
        }

        return (string) implode(', ', $labels);
    }
}
