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
     *   Collection to compare this collection with.
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $collection)
    {
        if (!$this->sameValueTypeAs($collection)) {
            return false;
        }

        if (!$this->sameCollectionCount($collection)) {
            return false;
        }

        if (!$this->sameCollectionValues($collection)) {
            return false;
        }

        return true;
    }

    /**
     * Check if collections have the same amount of items.
     *
     * @param \StadGent\Services\OpeningHours\Value\ValueInterface|CollectionAbstract $collection
     *   Collection to compare this collection with.
     *
     * @return bool
     */
    protected function sameCollectionCount(ValueInterface $collection)
    {
        $collectionIterator = $collection->getIterator();
        return $this->getIterator()->count() === $collectionIterator->count();
    }

    /**
     * Check if collections have the same values.
     *
     * @param \StadGent\Services\OpeningHours\Value\ValueInterface|CollectionAbstract $collection
     *   Collection to compare this collection with.
     *
     * @return bool
     */
    protected function sameCollectionValues(ValueInterface $collection)
    {
        $collectionIterator = $collection->getIterator();
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
