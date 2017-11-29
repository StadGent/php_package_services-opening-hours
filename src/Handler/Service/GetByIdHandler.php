<?php

namespace StadGent\Services\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Request\Service\GetByIdRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\Value\Service;
use Psr\Http\Message as Psr;

/**
 * Handler to Get a Service by its ID.
 *
 * @package StadGent\Services\OpeningHours\Handler\Service
 */
class GetByIdHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return GetByIdRequest::class;
    }

    /**
     * @inheritDoc
     *
     * @throws \StadGent\Services\OpeningHours\Response\Exception\InvalidResponseException
     * @throws \InvalidArgumentException
     */
    public function toResponse(Psr\ResponseInterface $response)
    {
        $this->validateResponse($response);
        $data = $this->getBodyData($response);
        $service = Service::fromArray($data);
        return new ServiceResponse($service);
    }
}
