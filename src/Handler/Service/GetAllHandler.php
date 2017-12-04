<?php

namespace StadGent\Services\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Request\Service\GetAllRequest;
use StadGent\Services\OpeningHours\Response\ServicesResponse;
use StadGent\Services\OpeningHours\Value\ServiceCollection;
use Psr\Http\Message as Psr;

/**
 * Handler to Get All Services.
 *
 * @package StadGent\Services\OpeningHours\Handler\Service
 */
class GetAllHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return GetAllRequest::class;
    }

    /**
     * @inheritDoc
     *
     * @throws \StadGent\Services\OpeningHours\Response\Exception\InvalidResponseException
     * @throws \InvalidArgumentException
     */
    public function toResponse(Psr\ResponseInterface $response)
    {
        $data = $this->getBodyData($response);

        // Check if not single result!
        // This is a fallback for when the API returns an object if only 1 item
        // is found.
        if (isset($data['id'])) {
            $data = [$data];
        }

        $collection = ServiceCollection::fromArray($data);
        return new ServicesResponse($collection);
    }
}
