<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;
use InvalidArgumentException;

/**
 * Object describing the date attributes (created & updated) of a record.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class DateAttributes extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The creation date-time.
     *
     * @var \StadGent\Services\OpeningHours\Value\DateTime
     */
    private DateTime $createdAt;

    /**
     * The last update date-time.
     *
     * @var \StadGent\Services\OpeningHours\Value\DateTime
     */
    private DateTime $updatedAt;

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
     * @throws \Exception
     *   If the array does not contains "createdAt" or "updatedAt" values.
     */
    public static function fromArray(array $data): DateAttributes
    {
        $attributes = new self();

        if (!array_key_exists('createdAt', $data)) {
            throw new InvalidArgumentException('The array should contain a "createdAt" value.');
        }
        if (!array_key_exists('updatedAt', $data)) {
            throw new InvalidArgumentException('The array should contain an "updatedAt" value.');
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
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Get the date-time the service was updated.
     *
     * @return \StadGent\Services\OpeningHours\Value\DateTime
     *   The DateTime object if an update date-time is set.
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Check if the given value object is the same as this.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\DateAttributes $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \StadGent\Services\OpeningHours\Value\DateAttributes $object */
        return
            $this->sameValueTypeAs($object)
            && $this->getCreatedAt()->sameValueAs($object->getCreatedAt())
            && $this->getUpdatedAt()->sameValueAs($object->getUpdatedAt());
    }

    /**
     * Get the string version of this object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getCreatedAt();
    }
}
