<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Object describing OpenNow status for a Channel.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class OpenNow extends ValueAbstract implements ValueFromArrayInterface
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
     * Is the channel now open.
     *
     * @var bool
     */
    protected $isOpen;

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
     * - openNow (array) : Array of following data:
     *   - status (bool) : Is Open.
     *   - label (string) : Status label (ignored).
     *
     * @inheritdoc
     *
     * @return \StadGent\Services\OpeningHours\Value\OpenNow
     *
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channel" value.
     * @throws \InvalidArgumentException
     *   If the data does not contain a "channelId" value.
     */
    public static function fromArray(array $data)
    {
        if (empty($data['channel'])) {
            throw new \InvalidArgumentException('The array should contain a "channel" value.');
        }
        if (empty($data['channelId'])) {
            throw new \InvalidArgumentException('The array should contain a "channelId" value.');
        }

        $openNow = new static();
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
     * Is the channel open.
     *
     * @return bool
     */
    public function isOpen()
    {
        return $this->isOpen;
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

        /* @var $object \StadGent\Services\OpeningHours\Value\OpenNow */
        return $this->getChannelId() === $object->getChannelId()
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
    public function __toString()
    {
        return (string) $this->getChannelLabel();
    }
}
