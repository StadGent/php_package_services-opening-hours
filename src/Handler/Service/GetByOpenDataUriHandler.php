<?php

namespace StadGent\Services\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Request\Service\GetByOpenDataUriRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\Value\Service;
use Psr\Http\Message as Psr;

/**
 * Handler to Get a Service by its open data URI.
 *
 * @package StadGent\Services\OpeningHours\Handler\Service
 */
class GetByOpenDataUriHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return [
            GetByOpenDataUriRequest::class,
        ];
    }

    /**
     * @inheritDoc
     *
     * @throws \InvalidArgumentException
     */
    public function toResponse(Psr\ResponseInterface $response)
    {
        $all = $this->getBodyData($response);
        $data = reset($all);
        $service = Service::fromArray($data);
        return new ServiceResponse($service);
    }
}
