<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Request\Service\GetAllRequest;
use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;
use StadGent\Services\OpeningHours\Response\ServicesResponse;
use StadGent\Services\OpeningHours\Value\ServiceCollection;
use Psr\Http\Message as Psr;

/**
 * Handler to Get All Services.
 *
 * @package StadGent\Services\OpeningHours\Handler\Service
 */
final class GetAllHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [
            GetAllRequest::class,
            SearchByLabelRequest::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ServicesResponse
    {
        $data = $this->getBodyData($response);
        $collection = ServiceCollection::fromArray($data);
        return new ServicesResponse($collection);
    }
}
