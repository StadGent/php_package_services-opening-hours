<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use Psr\Http\Message as Psr;
use StadGent\Services\OpeningHours\Value\OpeningHours;

/**
 * Abstract Handler to extract the OpeningHours data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
abstract class OpeningHoursAbstractHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     *
     * @throws \InvalidArgumentException
     */
    public function toResponse(Psr\ResponseInterface $response)
    {
        $data = $this->getBodyData($response);
        $openingHours = OpeningHours::fromArray($data);
        return new OpeningHoursResponse($openingHours);
    }
}
