<?php

namespace StadGent\Services\OpeningHours\Handler\Channel;

use StadGent\Services\OpeningHours\Handler\HandlerAbstract;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowRequest;
use StadGent\Services\OpeningHours\Response\OpenNowResponse;
use Psr\Http\Message as Psr;
use StadGent\Services\OpeningHours\Value\OpenNow;

/**
 * Handler to extract the OpenNow data from the response.
 *
 * @package StadGent\Services\OpeningHours\Handler\Channel
 */
class OpenNowHandler extends HandlerAbstract
{
    /**
     * @inheritDoc
     */
    public function handles()
    {
        return [
            OpenNowRequest::class,
        ];
    }

    /**
     * @inheritDoc
     *
     * @throws \InvalidArgumentException
     */
    public function toResponse(Psr\ResponseInterface $response)
    {
        $data = $this->getBodyData($response);
        $openNow = OpenNow::fromArray($data);
        return new OpenNowResponse($openNow);
    }
}
