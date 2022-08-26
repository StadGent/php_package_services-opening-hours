<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use StadGent\Services\OpeningHours\Value\Channel;

/**
 * Response object containing a single Channel.
 *
 * @package StadGent\Services\OpeningHours\Response
 */
final class ChannelResponse implements ResponseInterface
{
    /**
     * The Channel in the response.
     *
     * @var \StadGent\Services\OpeningHours\Value\Channel
     */
    private Channel $channel;

    /**
     * ChannelResponse constructor.
     *
     * @param \StadGent\Services\OpeningHours\Value\Channel $channel
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * Get the Channel.
     *
     * @return \StadGent\Services\OpeningHours\Value\Channel
     */
    public function getChannel(): Channel
    {
        return $this->channel;
    }
}
