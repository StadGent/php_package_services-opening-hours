<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Object value representing a Boolean value.
 *
 * @package Gent\Zalenzoeker\Value
 */
class Boolean extends ValueAbstract
{
    /**
     * The boolean state.
     *
     * @var bool
     */
    private $state;

    /**
     * Boolean constructor.
     *
     * @param mixed $value
     */
    public function __construct($value = false)
    {
        if (is_bool($value)) {
            $this->state = $value;
            return;
        }

        if (is_numeric($value)) {
            $this->state = (int) $value === 1;
            return;
        }

        if (!is_string($value)) {
            $this->state = false;
            return;
        }

        if (strtolower($value) === 'yes') {
            $this->state = true;
            return;
        }

        $this->state = strtolower($value) === 'y';
    }

    /**
     * As false value.
     *
     * @return \StadGent\Services\OpeningHours\Value\Boolean
     */
    public static function false()
    {
        return new static(false);
    }

    /**
     * As true value.
     *
     * @return \StadGent\Services\OpeningHours\Value\Boolean
     */
    public static function true()
    {
        return new static(true);
    }

    /**
     * Is the boolean state true?
     *
     * @return bool
     */
    public function isTrue()
    {
        return $this->state === true;
    }

    /**
     * Is the boolean value false?
     *
     * @return bool
     */
    public function isFalse()
    {
        return $this->state === false;
    }

    /**
     * Get the value as boolean.
     *
     * @return bool
     */
    public function getAsBoolean()
    {
        return $this->state;
    }

    /**
     * Get the value as true or false.
     *
     * @return string
     */
    public function getAsTrueFalse()
    {
        return $this->state
            ? 'true'
            : 'false';
    }

    /**
     * Get as integer.
     *
     * @return int
     */
    public function getAsInteger()
    {
        return (int) $this->state;
    }

    /**
     * As Yes/No value.
     *
     * @return string
     */
    public function getAsYesNo()
    {
        return $this->state
          ? 'Yes'
          : 'No';
    }

    /**
     * As Y/N value.
     *
     * @return string
     */
    public function getAsYN()
    {
        return $this->state
          ? 'Y'
          : 'N';
    }

    /**
     * @inheritdoc
     */
    public function sameValueAs(ValueInterface $object)
    {
        /* @var $object \StadGent\Services\OpeningHours\Value\Boolean */

        return (
          $this->sameValueTypeAs($object)
          && $this->getAsBoolean() === $object->getAsBoolean()
        );
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->getAsYN();
    }
}
