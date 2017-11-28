<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Object describing a collection of Services.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class ServiceCollection extends CollectionAbstract implements ValueFromArrayInterface
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
     * @inheritdoc
     *
     * @returns \StadGent\Services\OpeningHours\Value\ServiceCollection
     *
     * @throws \InvalidArgumentException
     *   If the created_at/update_at are empty.
     */
    public static function fromArray(array $data)
    {
        $collection = new static();

        foreach ($data as $key => $item) {
            $collection->values[$key] = Service::fromArray($item);
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
            /* @var $value \StadGent\Services\OpeningHours\Value\Service */
            $labels[] = $value->getLabel();
        }

        return (string) implode(', ', $labels);
    }
}
