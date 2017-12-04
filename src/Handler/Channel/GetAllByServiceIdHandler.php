<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Request\Channel\GetAllByServiceIdRequest;
use StadGent\Services\OpeningHours\Response\ChannelsResponse;
use StadGent\Services\OpeningHours\Value\ChannelCollection;
use Psr\Http\Message as Psr;

/**
 * Handler to Get All Channels.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class GetAllByServiceIdHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return GetAllByServiceIdRequest::class;
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
        $collection = ChannelCollection::fromArray($data);
        return new ChannelsResponse($collection);
    }
}
