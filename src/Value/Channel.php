<?php

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueFromArrayInterface;
use DigipolisGent\Value\ValueInterface;

/**
 * Object describing a single channel.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class Channel extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The Channel ID.
     *
     * @var int
     */
    protected $id;

    /**
     * The Channel label (name).
     *
     * @var string
     */
    protected $label;

    /**
     * The Service ID the Channel belongs to.
     *
     * @var int
     */
    protected $serviceId;

    /**
     * The date attributes for the Channel.
     *
     * @var \StadGent\Services\OpeningHours\Value\DateAttributes
     */
    protected $dateAttributes;

    /**
     * Use only the named constructors.
     */
    protected function __construct()
    {
        // The constructor is protected:
        // Create the object using the named constructors.
    }

    /**
     * Create a new Channel from an array of data.
     *
     * The array may contain following data:
     * - id (int) : The Channel ID.
     * - label (string) : The Channel label (name).
     * - serviceId (int) : The Service id the Channel belongs to.
     * - createdAt (string) : The creation date of the Channel.
     * - updatedAt (string) : The last update date of the Channel.
     *
     * @inheritdoc
     *
     * @return \StadGent\Services\OpeningHours\Value\Channel
     *
     * @throws \InvalidArgumentException
     *   If the created_at/update_at are empty.
     */
    public static function fromArray(array $data)
    {
        $channel = new self();

        if (!empty($data['id'])) {
            $channel->id = (int) $data['id'];
        }
        if (!empty($data['label'])) {
            $channel->label = $data['label'];
        }
        if (!empty($data['serviceId'])) {
            $channel->serviceId = (int) $data['serviceId'];
        }

        $channel->dateAttributes = DateAttributes::fromArray($data);

        return $channel;
    }


    /**
     * Get the unique identifier for the Channel.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the Channel label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get the Service ID the channel belongs to.
     *
     * @return int
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Get the date-time the Channel was created.
     *
     * @return \StadGent\Services\OpeningHours\Value\DateAttributes
     */
    public function getDateAttributes()
    {
        return $this->dateAttributes;
    }

    /**
     * Check if the given value object is the same as this.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\Channel $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object)
    {
        if (!$this->sameValueTypeAs($object) || !$object instanceof Channel) {
            return false;
        }

        return $this->getId() === $object->getId()
            && $this->getLabel() === $object->getLabel()
            && $this->getServiceId() === $object->getServiceId()
            && $this->getDateAttributes()->sameValueAs($object->getDateAttributes())
            ;
    }

    public function __toString()
    {
        return (string) $this->getLabel();
    }
}
