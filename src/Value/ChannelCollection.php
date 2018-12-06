<?php

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\CollectionAbstract;
use DigipolisGent\Value\ValueFromArrayInterface;

/**
 * Object describing a collection of Channels.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class ChannelCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     * Create a Collection of Channel objects from an array of data.
     *
     * The array may contain a set of Channel array data.
     * @see \StadGent\Services\OpeningHours\Value\Channel.
     *
     * @param array $data
     *   The array to extract the collection from.
     *
     * @return \StadGent\Services\OpeningHours\Value\ChannelCollection
     *
     * @throws \InvalidArgumentException
     *   If the createdAt/updateAt are empty.
     */
    public static function fromArray(array $data)
    {
        $collection = new static();

        foreach ($data as $key => $item) {
            $collection->values[$key] = Channel::fromArray($item);
        }

        return $collection;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        $labels = [];
        foreach ($this->values as $value) {
            /* @var $value \StadGent\Services\OpeningHours\Value\Channel */
            $labels[] = $value->getLabel();
        }

        return (string) implode(', ', $labels);
    }
}
