<?php

namespace StadGent\Services\OpeningHours\Value;

use DateTimeImmutable;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Date value object.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class Date extends ValueAbstract
{
    /**
     * The internal dateTime object.
     *
     * @var \DateTimeImmutable
     */
    protected $dateTime;

    /**
     * Date constructor.
     *
     * @param string $date
     *   The date in Y-m-d format.
     */
    public function __construct($date)
    {
        $dateString = sprintf('%sT00:00:00+00:00', $date);
        $this->dateTime = new DateTimeImmutable($dateString);
    }

    /**
     * Get a formatted version of the date.
     *
     * @param string $format
     *   The desired format, default Y-m-d
     *   Format accepted by  {@link http://www.php.net/manual/en/function.date.php date()}.
     *
     * @return string
     *   The formatted date as string.
     */
    public function format($format = 'Y-m-d')
    {
        return $this->dateTime->format($format);
    }

    /**
     * Compare this Date with another given Date object.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\Date $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object)
    {
        if (!$this->sameValueTypeAs($object) || !$object instanceof Date) {
            return false;
        }

        return $this->format() === $object->format();
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return (string) $this->format();
    }
}
