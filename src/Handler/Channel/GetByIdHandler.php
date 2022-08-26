<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Request\Channel\GetByIdRequest;
use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\OpeningHours\Value\Channel;
use Psr\Http\Message as Psr;

/**
 * Handler to Get a Channel by its Service and Channel ID.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
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
    public function toResponse(Psr\ResponseInterface $response): ChannelResponse
    {
        $data = $this->getBodyData($response);
        $channel = Channel::fromArray($data);
        return new ChannelResponse($channel);
    }
}
