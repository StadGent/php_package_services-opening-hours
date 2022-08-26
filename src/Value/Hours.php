<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;
use InvalidArgumentException;

/**
 * Object describing a single from - until hours.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class Hours extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The from hour.
     *
     * @var string
     */
    private string $from;

    /**
     * The until hour.
     *
     * @var string
     */
    private string $until;

    /**
     * Use only the named constructors.
     */
    private function __construct()
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
     *   If the data does not contain a "from" or "until" value.
     */
    public static function fromArray(array $data): Hours
    {
        if (empty($data['from'])) {
            throw new InvalidArgumentException('The array should contain a "from" value.');
        }
        if (empty($data['until'])) {
            throw new InvalidArgumentException('The array should contain an "until" value.');
        }

        return self::fromHours($data['from'], $data['until']);
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
    public static function fromHours(string $from, string $until): Hours
    {
        $hours = new self();
        $hours->from = $from;
        $hours->until = $until;
        return $hours;
    }

    /**
     * Get the start hour of an open period.
     *
     * @return string
     */
    public function getFromHour(): string
    {
        return $this->from;
    }

    /**
     * Get the until hour of an open period.
     *
     * @return string
     */
    public function getUntilHour(): string
    {
        return $this->until;
    }

    /**
     * Check if the given value object is the same as this.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\Hours $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \StadGent\Services\OpeningHours\Value\Hours $object */
        return $this->sameValueTypeAs($object)
            && $this->getFromHour() === $object->getFromHour()
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
    public function __toString(): string
    {
        return sprintf('%s > %s', $this->getFromHour(), $this->getUntilHour());
    }
}
