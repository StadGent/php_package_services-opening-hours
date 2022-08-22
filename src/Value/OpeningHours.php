<?php

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueFromArrayInterface;
use DigipolisGent\Value\ValueInterface;
use InvalidArgumentException;

/**
 * Object describing the set of Opening Hours for a Channel.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class OpeningHours extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The Channel ID.
     *
     * @var int
     */
    protected $channelId;

    /**
     * The Channel label.
     *
     * @var string
     */
    protected $channelLabel;

    /**
     * The opening hours days.
     *
     * @var \StadGent\Services\OpeningHours\Value\DayCollection.
     */
    protected $days;

    /**
     * Use only the named constructors.
     */
    protected function __construct()
    {
        // The constructor is protected:
        // Create the object using the named constructors.
    }

    /**
     * Create a new OpeningHours from an array of data.
     *
     * The array may contain following data:
     * - channel (string) : The Channel label.
     * - channelId (int) : The channel ID.
     * - openinghours (array) : Array of days array data.
     *
     * @inheritdoc
     *
     * @return \StadGent\Services\OpeningHours\Value\OpeningHours
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channel" or "channelId" value.
     */
    public static function fromArray(array $data)
    {
        if (empty($data['channel'])) {
            throw new InvalidArgumentException('The array should contain a "channel" value.');
        }
        if (empty($data['channelId'])) {
            throw new InvalidArgumentException('The array should contain a "channelId" value.');
        }

        $openingHours = new self();
        $openingHours->channelLabel = $data['channel'];
        $openingHours->channelId = (int) $data['channelId'];

        $days = !empty($data['openinghours']) && is_array($data['openinghours'])
            ? $data['openinghours']
            : [];
        $openingHours->days = DayCollection::fromArray($days);

        return $openingHours;
    }

    /**
     * Get the channel ID.
     *
     * @return int
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Get the channel label.
     *
     * @return string
     */
    public function getChannelLabel()
    {
        return $this->channelLabel;
    }

    /**
     * @return \StadGent\Services\OpeningHours\Value\DayCollection
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Check if the given value object is the same as this.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\OpeningHours $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object)
    {
        if (!$this->sameValueTypeAs($object) || !$object instanceof OpeningHours) {
            return false;
        }

        /* @var $object \StadGent\Services\OpeningHours\Value\OpeningHours */
        return $this->getChannelId() === $object->getChannelId()
            && $this->getChannelLabel() === $object->getChannelLabel()
            && $this->getDays()->sameValueAs($object->getDays())
            ;
    }

    public function __toString()
    {
        return (string) $this->getChannelLabel();
    }
}
