<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Object describing a collection of OpeningHours.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class OpeningHoursCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     *
     * @param array $data
     *   Array of OpeningHours data.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpeningHoursCollection
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     *   If one of the items does not have a date.
     * @see \StadGent\Services\OpeningHours\Value\OpeningHours.
     *
     */
    public static function fromArray(array $data): OpeningHoursCollection
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
    public function __toString(): string
    {
        $labels = [];
        foreach ($this->values as $value) {
            $labels[] = (string) $value;
        }

        return implode(', ', $labels);
    }
}
