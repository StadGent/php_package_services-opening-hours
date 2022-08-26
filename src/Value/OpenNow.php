<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;
use InvalidArgumentException;

/**
 * Object describing OpenNow status for a Channel.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class OpenNow extends ValueAbstract implements ValueFromArrayInterface
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
     * Is the channel now open.
     *
     * @var bool
     */
    private bool $isOpen;

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
     * - openNow (array) : Array of following data:
     *   - status (bool) : Is Open.
     *   - label (string) : Status label (ignored).
     *
     * @inheritdoc
     *
     * @return \StadGent\Services\OpeningHours\Value\OpenNow
     *
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channel" or "channelId" value.
     */
    public static function fromArray(array $data): OpenNow
    {
        if (empty($data['channel'])) {
            throw new InvalidArgumentException('The array should contain a "channel" value.');
        }
        if (empty($data['channelId'])) {
            throw new InvalidArgumentException('The array should contain a "channelId" value.');
        }

        $openNow = new self();
        $openNow->channelLabel = $data['channel'];
        $openNow->channelId = (int) $data['channelId'];
        $openNow->isOpen = !empty($data['openNow']['status']);

        return $openNow;
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
     * Is the channel open.
     *
     * @return bool
     */
    public function isOpen(): bool
    {
        return $this->isOpen;
    }

    /**
     * Check if the given value object is the same as this.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\OpenNow $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \StadGent\Services\OpeningHours\Value\OpenNow $object */
        return $this->sameValueTypeAs($object)
            && $this->getChannelId() === $object->getChannelId()
            && $this->getChannelLabel() === $object->getChannelLabel()
            && $this->isOpen() === $object->isOpen()
            ;
    }

    /**
     * Get the string version of the openNow object.
     *
     * @return string
     *   The Channel label.
     */
    public function __toString(): string
    {
        return $this->getChannelLabel();
    }
}
