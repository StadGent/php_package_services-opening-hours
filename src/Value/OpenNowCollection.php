<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Object describing a collection of OpenNow value objects.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class OpenNowCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     * @param array
     *   Array of OpenNow data.
     *
     * @returns \StadGent\Services\OpeningHours\Value\OpenNowCollection
     *
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channel" value.
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channelId" value.
     */
    public static function fromArray(array $data)
    {
        $collection = new static();

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
