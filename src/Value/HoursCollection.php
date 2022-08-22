<?php

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\CollectionAbstract;
use DigipolisGent\Value\ValueFromArrayInterface;

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
    public static function fromArray(array $data)
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
    public function __toString()
    {
        $labels = [];
        foreach ($this->values as $value) {
            /* @var $value \StadGent\Services\OpeningHours\Value\Hours */
            $labels[] = (string) $value;
        }

        return (string) implode(', ', $labels);
    }
}
