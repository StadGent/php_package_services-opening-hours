<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Object describing the service Source.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
final class ServiceSource extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The service identifier.
     *
     * @var string|null
     */
    private ?string $sourceId;

    /**
     * The data source for the service.
     *
     * @var string|null
     */
    private ?string $name;

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
     * - sourceIdentifier (string) : The source identifier of the service.
     * - source (string) : The source of the service.
     *
     * @param array $data
     *   An array containing the service data.
     *
     * @return \StadGent\Services\OpeningHours\Value\ServiceSource
     *   The Service Source object.
     */
    public static function fromArray(array $data): ServiceSource
    {
        $service = new self();

        $service->sourceId = $data['sourceIdentifier'] ?? null;
        $service->name = $data['source'] ?? null;

        return $service;
    }

    /**
     * Get the identifier for the service at the source.
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->sourceId;
    }

    /**
     * Get the source name.
     *
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Check if the given value object is the same as this.
     *
     * @param \DigipolisGent\Value\ValueInterface|\StadGent\Services\OpeningHours\Value\ServiceSource $object
     *
     * @return bool
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \StadGent\Services\OpeningHours\Value\ServiceSource $object */
        return $this->sameValueTypeAs($object)
            && $this->getId() === $object->getId()
            && $this->getName() === $object->getName();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) $this->getName();
    }
}
