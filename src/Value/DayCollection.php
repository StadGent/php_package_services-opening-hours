<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Object describing a collection of Days.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class DayCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     * @param array $data
     *   Array of days data.
     *
     * @return \StadGent\Services\OpeningHours\Value\DayCollection
     *
     * @throws \InvalidArgumentException
     *   If one of the items does not have a date.
     */
    public static function fromArray(array $data): DayCollection
    {
        $collection = new self();

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
    public function __toString(): string
    {
        $labels = [];
        foreach ($this->values as $value) {
            $labels[] = (string) $value;
        }

        return implode(', ', $labels);
    }
}
