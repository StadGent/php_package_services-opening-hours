<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Object describing a single channel.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class Channel extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The Channel ID.
     *
     * @var int|null
     */
    private ?int $channelId;

    /**
     * The Channel label (name).
     *
     * @var string|null
     */
    private ?string $label;

    /**
     * The Service ID the Channel belongs to.
     *
     * @var int|null
     */
    private ?int $serviceId;

    /**
     * The date attributes for the Channel.
     *
     * @var \StadGent\Services\OpeningHours\Value\DateAttributes
     */
    private DateAttributes $dateAttributes;

    /**
     * Use only the named constructors.
     */
    private function __construct()
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
    public static function fromArray(array $data): Channel
    {
        $channel = new self();

        $channel->channelId = !empty($data['id']) ? (int) $data['id'] : null;
        $channel->label = $data['label'] ?? null;
        $channel->serviceId = !empty($data['serviceId']) ? (int) $data['serviceId'] : null;

        $channel->dateAttributes = DateAttributes::fromArray($data);

        return $channel;
    }


    /**
     * Get the unique identifier for the Channel.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->channelId;
    }

    /**
     * Get the Channel label.
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Get the Service ID the channel belongs to.
     *
     * @return int|null
     */
    public function getServiceId(): ?int
    {
        return $this->serviceId;
    }

    /**
     * Get the date-time the Channel was created.
     *
     * @return \StadGent\Services\OpeningHours\Value\DateAttributes
     */
    public function getDateAttributes(): DateAttributes
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
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \StadGent\Services\OpeningHours\Value\Channel $object */
        return
            $this->sameValueTypeAs($object)
            && $this->getId() === $object->getId()
            && $this->getLabel() === $object->getLabel()
            && $this->getServiceId() === $object->getServiceId()
            && $this->getDateAttributes()->sameValueAs($object->getDateAttributes())
            ;
    }

    public function __toString(): string
    {
        return (string) $this->getLabel();
    }
}
