<?php

namespace StadGent\Services\OpeningHours\Value;

/**
 * Object describing a single service.
 *
 * @package StadGent\Services\OpeningHours\Value
 */
class Service extends ValueAbstract implements ValueFromArrayInterface
{
    /**
     * The service ID.
     *
     * @var int
     */
    protected $id;

    /**
     * The URI of the services.
     *
     * @var string
     */
    protected $uri;

    /**
     * The service label (name).
     *
     * @var string
     */
    protected $label;

    /**
     * The service description.
     *
     * @var string
     */
    protected $description;

    /**
     * The date attributes for the Service.
     *
     * @var \StadGent\Services\OpeningHours\Value\DateAttributes
     */
    protected $dateAttributes;

    /**
     * The data source for the service.
     *
     * @var \StadGent\Services\OpeningHours\Value\ServiceSource
     */
    protected $source;

    /**
     * Is the service a draft item.
     *
     * @var bool
     */
    protected $isDraft;

    /**
     * The number of channels linked to this service.
     *
     * @param int
     */
    protected $countChannels = 0;

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
     * - id (int) : The service ID.
     * - uri (string) : The service URI.
     * - label (string) : The service label (name).
     * - description (string) : Description of the service.
     * - created_at (string) : The creation date of the service.
     * - updated_at (string) : The last update date of the service.
     * - identifier (string) : The source identifier of the service.
     * - source (string) : The source of the service.
     * - draft (0/1) : Has the service the draft status.
     * - countChannels (int) : The number of channels linked to the service.
     *
     * @inheritdoc
     *
     * @return \StadGent\Services\OpeningHours\Value\Service
     *
     * @throws \InvalidArgumentException
     *   If the created_at/update_at are empty.
     */
    public static function fromArray(array $data)
    {
        $service = new static();

        if (!empty($data['id'])) {
            $service->id = (int) $data['id'];
        }
        if (!empty($data['uri'])) {
            $service->uri = $data['uri'];
        }
        if (!empty($data['label'])) {
            $service->label = $data['label'];
        }
        if (!empty($data['description'])) {
            $service->description = $data['description'];
        }
        if (!empty($data['countChannels'])) {
            $service->countChannels = (int) $data['countChannels'];
        }

        $service->source = ServiceSource::fromArray($data);
        $service->dateAttributes = DateAttributes::fromArray($data);
        $service->isDraft = !empty($data['source']);

        return $service;
    }


    /**
     * Get the unique identifier for the Service.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the URI of the service.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get the service label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get the service description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the date-time the service was created.
     *
     * @return \StadGent\Services\OpeningHours\Value\DateAttributes
     */
    public function getDateAttributes()
    {
        return $this->dateAttributes;
    }

    /**
     * Get the source name (if any) of the service.
     *
     * @return \StadGent\Services\OpeningHours\Value\ServiceSource
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Check if the service has a source.
     *
     * @return bool
     */
    public function hasSource()
    {
        return $this->getSource()->getName() !== null
            && $this->getSource()->getId() !== null;
    }

    /**
     * Check if the service is in draft status.
     *
     * @return bool
     */
    public function isDraft()
    {
        return $this->isDraft;
    }

    /**
     * Get the number of channels this service has.
     *
     * @return int
     */
    public function getCountChannels()
    {
        return $this->countChannels;
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

        /* @var $object \StadGent\Services\OpeningHours\Value\Service */
        return $this->getId() === $object->getId()
            && $this->getUri() === $object->getUri()
            && $this->getLabel() === $object->getLabel()
            && $this->getDescription() === $object->getDescription()
            && $this->getDateAttributes()->sameValueAs($object->getDateAttributes())
            && $this->getSource()->sameValueAs($object->getSource())
            && $this->isDraft() === $object->isDraft()
            && $this->getCountChannels() === $object->getCountChannels();
    }

    public function __toString()
    {
        return (string) $this->getLabel();
    }
}
