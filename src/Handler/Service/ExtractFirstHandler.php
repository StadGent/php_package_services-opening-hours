<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Request\Service\GetByOpenDataUriRequest;
use StadGent\Services\OpeningHours\Request\Service\GetBySourceIdRequest;
use StadGent\Services\OpeningHours\Response\ServiceResponse;
use StadGent\Services\OpeningHours\Value\Service;
use Psr\Http\Message as Psr;

/**
 * Handler to extract the first item from all services response.
 *
 * Is used to extract all services responses where there is filtered by a single
 * sourceId or Uri.
 */
final class ExtractFirstHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [
            GetByOpenDataUriRequest::class,
            GetBySourceIdRequest::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ServiceResponse
    {
        $all = $this->getBodyData($response);
        $data = $all;
        if (!empty($all)) {
            $data = reset($all);
        }
        $service = Service::fromArray($data);
        return new ServiceResponse($service);
    }
}
