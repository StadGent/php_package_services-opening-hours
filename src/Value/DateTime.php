<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DateTimeImmutable;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * DateTime value object.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class DateTime extends ValueAbstract
{
    /**
     * The dateTime
     *
     * @var \DateTimeImmutable
     */
    private DateTimeImmutable $dateTime;

    /**
     * Date constructor.
     *
     * @param string $dateTime
     *
     * @throws \Exception
     */
    public function __construct(string $dateTime)
    {
        $this->dateTime = new DateTimeImmutable($dateTime);
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
    public function format(string $format): string
    {
        return $this->dateTime->format($format);
    }

    /**
     * Compare this Date with another given Date object.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\DateTime $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \StadGent\Services\OpeningHours\Value\DateTime $object */
        return
            $this->sameValueTypeAs($object)
            && $this->dateTime->getTimestamp() === $object->dateTime->getTimestamp();
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->format(DATE_ATOM);
    }
}
