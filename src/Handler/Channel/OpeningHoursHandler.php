<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Handler\Channel;

use Psr\Http\Message as Psr;
use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursDayRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursMonthRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursPeriodRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekRequest;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursYearRequest;
use StadGent\Services\OpeningHours\Value\OpeningHours;

/**
 * Handler to extract the OpeningHours data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
final class OpeningHoursHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [
            OpeningHoursDayRequest::class,
            OpeningHoursWeekRequest::class,
            OpeningHoursMonthRequest::class,
            OpeningHoursYearRequest::class,
            OpeningHoursPeriodRequest::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): OpeningHoursResponse
    {
        $data = $this->getBodyData($response);
        $openingHours = OpeningHours::fromArray($data);
        return new OpeningHoursResponse($openingHours);
    }
}
