<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Request\Channel\GetByServiceAndChannelIdRequest;
use StadGent\Services\OpeningHours\Response\ChannelResponse;
use StadGent\Services\OpeningHours\Response\Validator\ServiceNotFoundValidator;
use StadGent\Services\OpeningHours\Value\Channel;
use Psr\Http\Message as Psr;

/**
 * Handler to Get a Channel by its Service and Channel ID.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class GetByServiceAndChannelIdHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return GetByServiceAndChannelIdRequest::class;
    }

    /**
     * @inheritDoc
     *
     * @throws \StadGent\Services\OpeningHours\Response\Exception\InvalidResponseException
     * @throws \InvalidArgumentException
     */
    public function toResponse(Psr\ResponseInterface $response)
    {
        $this->validateResponse(
            $response,
            [
                new ServiceNotFoundValidator(),
            ]
        );
        $data = $this->getBodyData($response);
        $channel = Channel::fromArray($data);
        return new ChannelResponse($channel);
    }
}
