<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Object describing a collection of Services.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class ServiceCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     * Create a Collection of Service objects from an array of data.
     *
     * The array may contain a set of Service array data.
     * @see \StadGent\Services\OpeningHours\Value\Service.
     *
     * @param array $data
     *   The array to extract the collection from.
     *
     * @return \StadGent\Services\OpeningHours\Value\ServiceCollection
     *
     * @throws \InvalidArgumentException
     *   If the createdAt/updateAt are empty.
     */
    public static function fromArray(array $data): ServiceCollection
    {
        $collection = new self();

        foreach ($data as $key => $item) {
            $collection->values[$key] = Service::fromArray($item);
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
            $labels[] = (string) $value;
        }

        return implode(', ', $labels);
    }
}
