<?php

declare(strict_types=1);

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
final class GetByIdHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [
            GetByIdRequest::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ServiceResponse
    {
        $data = $this->getBodyData($response);
        $service = Service::fromArray($data);
        return new ServiceResponse($service);
    }
}
