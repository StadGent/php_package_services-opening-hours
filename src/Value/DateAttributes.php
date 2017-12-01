<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Object describing the date attributes (created & updated) of a record.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class DateAttributes extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The creation date-time.
     *
     * @var \StadGent\Services\OpeningHours\Value\DateTime|null
     */
    protected $createdAt;

    /**
     * The last update date-time.
     *
     * @var \StadGent\Services\OpeningHours\Value\DateTime|null
     */
    protected $updatedAt;

    /**
     * Use only the named constructors.
     */
    protected function __construct()
    {
        // The constructor is protected:
        // Create the object using the named constructors.
    }

    /**
     * Create a new DateAttribute from an array of data.
     *
     * The array must contain following data:
     * - createdAt (string) : The creation date of the service.
     * - updatedAt (string) : The last update date of the service.
     *
     * @param array $data
     *   An array containing the service data.
     *
     * @return \StadGent\Services\OpeningHours\Value\DateAttributes
     *   The Date Attributes object.
     *
     * @throws \InvalidArgumentException
     *   If the array does not contains "createdAt" or "updatedAt" values.
     */
    public static function fromArray(array $data)
    {
        $attributes = new static();

        if (!array_key_exists('createdAt', $data)) {
            throw new \InvalidArgumentException('The array should contain a "createdAt" value.');
        }
        if (!array_key_exists('updatedAt', $data)) {
            throw new \InvalidArgumentException('The array should contain an "updatedAt" value.');
        }

        $attributes->createdAt = new DateTime($data['createdAt']);
        $attributes->updatedAt = new DateTime($data['updatedAt']);

        return $attributes;
    }

    /**
     * Get the date-time the service was created.
     *
     * @return \StadGent\Services\OpeningHours\Value\DateTime
     *   The DateTime object if a created date-time is set.
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get the date-time the service was updated.
     *
     * @return \StadGent\Services\OpeningHours\Value\DateTime
     *   The DateTime object if an update date-time is set.
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Check if the given value object is the same as this.
     *
     * @param \StadGent\Services\OpeningHours\Value\ValueInterface $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object)
    {
        if (!$this->sameValueTypeAs($object)) {
            return false;
        }

        /* @var $object \StadGent\Services\OpeningHours\Value\DateAttributes */
        return $this->getCreatedAt()->sameValueAs($object->getCreatedAt())
            && $this->getUpdatedAt()->sameValueAs($object->getUpdatedAt());
    }

    /**
     * Get the string version of this object.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getCreatedAt();
    }
}
