<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Object describing a single service.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class Service extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The service ID.
     *
     * @var int|null
     */
    private ?int $serviceId;

    /**
     * The URI of the services.
     *
     * @var string|null
     */
    private ?string $uri;

    /**
     * The service label (name).
     *
     * @var string|null
     */
    private ?string $label;

    /**
     * The service description.
     *
     * @var string|null
     */
    private ?string $description;

    /**
     * The date attributes for the Service.
     *
     * @var \StadGent\Services\OpeningHours\Value\DateAttributes
     */
    private DateAttributes $dateAttributes;

    /**
     * The data source for the service.
     *
     * @var \StadGent\Services\OpeningHours\Value\ServiceSource
     */
    private ServiceSource $source;

    /**
     * Is the service a draft item.
     *
     * @var bool
     */
    private bool $isDraft;

    /**
     * Use only the named constructors.
     */
    private function __construct()
    {
        // The constructor is protected:
        // Create the object using the named constructors.
    }

    /**
     * Create a new Service from an array of data.
     *
     * The array may contain following data:
     * - id (int) : The service ID.
     * - uri (string) : The service URI.
     * - label (string) : The service label (name).
     * - description (string) : Description of the service.
     * - createdAt (string) : The creation date of the service.
     * - updatedAt (string) : The last update date of the service.
     * - sourceIdentifier (string) : The source identifier of the service.
     * - source (string) : The source of the service.
     * - draft (bool) : Has the service the draft status.
     *
     * @inheritdoc
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     *
     * @throws \InvalidArgumentException
     *   If the createdAt/updateAt are empty.
     */
    public static function fromArray(array $data): Service
    {
        $service = new self();

        $service->serviceId = !empty($data['id']) ? (int) $data['id'] : null;
        $service->uri = $data['uri'] ?? null;
        $service->label = $data['label'] ?? null;
        $service->description = $data['description'] ?? null;

        $service->source = ServiceSource::fromArray($data);
        $service->dateAttributes = DateAttributes::fromArray($data);
        $service->isDraft = !empty($data['source']);

        return $service;
    }


    /**
     * Get the unique identifier for the Service.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->serviceId;
    }

    /**
     * Get the URI of the service.
     *
     * @return string|null
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }

    /**
     * Get the service label.
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Get the service description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Get the date-time the service was created.
     *
     * @return \StadGent\Services\OpeningHours\Value\DateAttributes
     */
    public function getDateAttributes(): DateAttributes
    {
        return $this->dateAttributes;
    }

    /**
     * Get the source name (if any) of the service.
     *
     * @return \StadGent\Services\OpeningHours\Value\ServiceSource
     */
    public function getSource(): ServiceSource
    {
        return $this->source;
    }

    /**
     * Check if the service has a source.
     *
     * @return bool
     */
    public function hasSource(): bool
    {
        return $this->getSource()->getName() !== null
            && $this->getSource()->getId() !== null;
    }

    /**
     * Check if the service is in draft status.
     *
     * @return bool
     */
    public function isDraft(): bool
    {
        return $this->isDraft;
    }

    /**
     * Check if the given value object is the same as this.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\Service $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \StadGent\Services\OpeningHours\Value\Service $object */
        return $this->sameValueTypeAs($object)
            && $this->getId() === $object->getId()
            && $this->getUri() === $object->getUri()
            && $this->getLabel() === $object->getLabel()
            && $this->getDescription() === $object->getDescription()
            && $this->getDateAttributes()->sameValueAs($object->getDateAttributes())
            && $this->getSource()->sameValueAs($object->getSource())
            && $this->isDraft() === $object->isDraft()
            ;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) $this->getLabel();
    }
}
