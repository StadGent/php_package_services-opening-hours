<?php

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueFromArrayInterface;
use DigipolisGent\Value\ValueInterface;
use InvalidArgumentException;

/**
 * Object describing a single Opening Hours Day.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class Day extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The Days date.
     *
     * @var \StadGent\Services\OpeningHours\Value\Date
     */
    protected $date;

    /**
     * Is open on this date.
     *
     * @var bool
     */
    protected $isOpen;

    /**
     * The hours for this day.
     *
     * @var \StadGent\Services\OpeningHours\Value\HoursCollection
     */
    protected $hours;

    /**
     * Use only the named constructors.
     */
    protected function __construct()
    {
        // The constructor is protected:
        // Create the object using the named constructors.
    }

    /**
     * Create a new Day from an array of data.
     *
     * The array may contain following data:
     * - date (string) : The day date.
     * - open (int) : Is open on this day.
     * - hours (array) : Array of hours (from, until).
     *
     * @inheritdoc
     *
     * @return \StadGent\Services\OpeningHours\Value\Day
     *
     * @throws \InvalidArgumentException
     *   If the data does not contain a date value.
     */
    public static function fromArray(array $data)
    {
        if (empty($data['date'])) {
            throw new InvalidArgumentException('The array should contain a "date" value.');
        }

        $day = new self();
        $day->date = new Date($data['date']);
        $day->isOpen = !empty($data['open']);

        $hours = !empty($data['hours']) && is_array($data['hours'])
            ? $data['hours']
            : [];
        $day->hours = HoursCollection::fromArray($hours);

        return $day;
    }

    /**
     * Get the day Date.
     *
     * @return \StadGent\Services\OpeningHours\Value\Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Has the day an open state.
     *
     * @return bool
     */
    public function isOpen()
    {
        return $this->isOpen;
    }

    /**
     * Get the hours collection for this day.
     *
     * @return \StadGent\Services\OpeningHours\Value\HoursCollection
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Check if the given value object is the same as this.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\Day $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object)
    {
        if (!$this->sameValueTypeAs($object) || !$object instanceof Day) {
            return false;
        }

        return $this->getDate()->sameValueAs($object->getDate())
            && $this->isOpen() === $object->isOpen()
            && $this->getHours()->sameValueAs($object->getHours())
            ;
    }

    public function __toString()
    {
        return (string) $this->getDate();
    }
}
