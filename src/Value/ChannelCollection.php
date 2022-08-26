<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Object describing a collection of Channels.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class ChannelCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     *
     * @param array $data
     *   The array to extract the collection from.
     *
     * @return \StadGent\Services\OpeningHours\Value\ChannelCollection
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     *   If the createdAt/updateAt are empty.
     * @see \StadGent\Services\OpeningHours\Value\Channel.
     *
     */
    public static function fromArray(array $data): ChannelCollection
    {
        $collection = new self();

        foreach ($data as $key => $item) {
            $collection->values[$key] = Channel::fromArray($item);
        }

        return $collection;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        $labels = [];
        foreach ($this->values as $value) {
            /** @var \StadGent\Services\OpeningHours\Value\Channel $value */
            $labels[] = $value->getLabel();
        }

        return implode(', ', $labels);
    }
}
