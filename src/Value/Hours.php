<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Object describing a single from - until hours.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class Hours extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The from hour.
     *
     * @var string
     */
    protected $from;

    /**
     * The until hour.
     *
     * @var string
     */
    protected $until;

    /**
     * Use only the named constructors.
     */
    protected function __construct()
    {
        // The constructor is protected:
        // Create the object using the named constructors.
    }

    /**
     * Create a new Hours object from an array of data.
     *
     * The array must contain following data:
     * - from (string) : The from hour in 24H time notation.
     * - until (string) : The until hour in 24H time notation.
     *
     * @inheritdoc
     *
     * @return \StadGent\Services\OpeningHours\Value\Hours
     *
     * @throws \InvalidArgumentException
     *   If the data does not contain a "from" value.
     * @throws \InvalidArgumentException
     *   If the data does not contain an "until" value.
     */
    public static function fromArray(array $data)
    {
        if (empty($data['from'])) {
            throw new \InvalidArgumentException('The array should contain a "from" value.');
        }
        if (empty($data['until'])) {
            throw new \InvalidArgumentException('The array should contain an "until" value.');
        }

        return static::fromHours($data['from'], $data['until']);
    }

    /**
     * Create the Hours object from From & Until hour values.
     *
     * @param string $from
     *   The from hour.
     * @param string $until
     *   The until hour.
     *
     * @return \StadGent\Services\OpeningHours\Value\Hours
     */
    public static function fromHours($from, $until)
    {
        $hours = new static();
        $hours->from = $from;
        $hours->until = $until;
        return $hours;
    }

    /**
     * Get the start hour of an open period.
     *
     * @return int
     */
    public function getFromHour()
    {
        return $this->from;
    }

    /**
     * Get the until hour of an open period.
     *
     * @return string
     */
    public function getUntilHour()
    {
        return $this->until;
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

        /* @var $object \StadGent\Services\OpeningHours\Value\Hours */
        return $this->getFromHour() === $object->getFromHour()
            && $this->getUntilHour() === $object->getUntilHour()
            ;
    }

    /**
     * Get the string representation of the hours.
     *
     * Will return "HH:MM > HH:MM".
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s > %s', $this->getFromHour(), $this->getUntilHour());
    }
}
