<?php

declare(strict_types=1);

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
final class GetByOpenDataUriHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [
            GetByOpenDataUriRequest::class,
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
