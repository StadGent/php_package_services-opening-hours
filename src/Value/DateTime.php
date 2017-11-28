<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Date value object.
 *
 * @package Gent\Zalenzoeker\Value
 */
class DateTime extends ValueAbstract
{

    /**
     * The dateTime
     *
     * @var \DateTimeImmutable
     */
    protected $dateTime;

    /**
     * Date constructor.
     *
     * @param string $dateTime
     */
    public function __construct($dateTime)
    {
        $this->dateTime = new \DateTimeImmutable($dateTime);
    }

    /**
     * Get a formatted version of the string.
     *
     * @param string $format
     *   The desired format.
     *   Format accepted by  {@link http://www.php.net/manual/en/function.date.php date()}.
     *
     * @return string
     *   The formatted date as string.
     */
    public function format($format)
    {
        return $this->dateTime->format($format);
    }

    /**
     * Compare this Date with another given Date object.
     *
     * @param ValueInterface|DateTime $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object)
    {
        if (!$this->sameValueTypeAs($object)) {
            return false;
        }

        return $this->dateTime->getTimestamp() === $object->dateTime->getTimestamp();
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return (string) $this->format(DATE_ATOM);
    }
}
