<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Object value representing a collection of items.
 */
abstract class CollectionAbstract extends ValueAbstract implements \IteratorAggregate
{
    /**
     * Collection of values.
     *
     * @var ValueInterface[]
     */
    protected $values = [];

    /**
     * Compare two Value objects and tells whether they can be considered equal.
     *
     * @param \StadGent\Services\OpeningHours\Value\ValueInterface|CollectionAbstract $collection
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $collection)
    {
        if (!$this->sameValueTypeAs($collection)) {
            return false;
        }

        $collectionIterator = $collection->getIterator();
        if ($this->getIterator()->count() !== $collectionIterator->count()) {
            return false;
        }

        foreach ($this as $index => $item) {
            if (!$collectionIterator->offsetExists($index)) {
                return false;
            }

            $collectionItem = $collectionIterator->offsetGet($index);
            if (!$item->sameValueAs($collectionItem)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the ArrayIterator.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->values);
    }
}
