<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Object describing a collection of Hours.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class HoursCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     * Create a Collection of Hours objects from an array of data.
     *
     * The array may contain a set of Hours array data.
     * @see \StadGent\Services\OpeningHours\Value\Hours.
     *
     * @param array $data
     *   The array to extract the collection from.
     *
     * @return \StadGent\Services\OpeningHours\Value\HoursCollection
     *
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channel" value.
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channelId" value.
     */
    public static function fromArray(array $data): HoursCollection
    {
        $collection = new self();

        foreach ($data as $key => $item) {
            $collection->values[$key] = Hours::fromArray($item);
        }

        return $collection;
    }

    /**
     * @inheritdoc
     *
     * Will return the opening hours separated by ", ":
     * 10:00 > 12:00, 12:30 > 18:00
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
