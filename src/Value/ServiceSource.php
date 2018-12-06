<?php

namespace StadGent\Services\OpeningHours\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueFromArrayInterface;
use DigipolisGent\Value\ValueInterface;

/**
 * Object describing the service Source.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class ServiceSource extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The service identifier.
     *
     * @var string
     */
    protected $id;

    /**
     * The data source for the service.
     *
     * @var string|null
     */
    protected $name;

    /**
     * Use only the named constructors.
     */
    protected function __construct()
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
    public static function fromArray(array $data)
    {
        $service = new static();

        if (!empty($data['sourceIdentifier'])) {
            $service->id = $data['sourceIdentifier'];
        }
        if (!empty($data['source'])) {
            $service->name = $data['source'];
        }

        return $service;
    }

    /**
     * Get the identifier for the service at the source.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the source name.
     *
     * @return null|string
     */
    public function getName()
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
    public function sameValueAs(ValueInterface $object)
    {
        if (!$this->sameValueTypeAs($object)) {
            return false;
        }

        /* @var $object \StadGent\Services\OpeningHours\Value\ServiceSource */
        return $this->getId() === $object->getId()
            && $this->getName() === $object->getName();
    }

    public function __toString()
    {
        return (string) $this->getName();
    }
}
