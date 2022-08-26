<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Object describing a collection of OpenNow value objects.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class OpenNowCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     * @see \StadGent\Services\OpeningHours\Value\OpenNow.
     *
     * @param array $data
     *   Array of OpenNow data.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpenNowCollection
     *
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channel" value.
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channelId" value.
     */
    public static function fromArray(array $data): OpenNowCollection
    {
        $collection = new self();

        foreach ($data as $key => $item) {
            $collection->values[$key] = OpenNow::fromArray($item);
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
