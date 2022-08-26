<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;
use InvalidArgumentException;

/**
 * Object describing the set of Opening Hours for a Channel.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class OpeningHours extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The Channel ID.
     *
     * @var int
     */
    private int $channelId;

    /**
     * The Channel label.
     *
     * @var string
     */
    private string $channelLabel;

    /**
     * The opening hours days.
     *
     * @var \StadGent\Services\OpeningHours\Value\DayCollection.
     */
    private DayCollection $days;

    /**
     * Use only the named constructors.
     */
    private function __construct()
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
    public static function fromArray(array $data): OpeningHours
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
    public function getChannelId(): int
    {
        return $this->channelId;
    }

    /**
     * Get the channel label.
     *
     * @return string
     */
    public function getChannelLabel(): string
    {
        return $this->channelLabel;
    }

    /**
     * @return \StadGent\Services\OpeningHours\Value\DayCollection
     */
    public function getDays(): DayCollection
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
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \StadGent\Services\OpeningHours\Value\OpeningHours $object */
        return $this->sameValueTypeAs($object)
            && $this->getChannelId() === $object->getChannelId()
            && $this->getChannelLabel() === $object->getChannelLabel()
            && $this->getDays()->sameValueAs($object->getDays())
            ;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getChannelLabel();
    }
}
