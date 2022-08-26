<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use StadGent\Services\OpeningHours\Value\ChannelCollection;

/**
 * Response object containing a collection of services.
 *
 * @package StadGent\Services\OpeningHours\Response
 */
final class ChannelsResponse implements ResponseInterface
{
    /**
     * Collection containing the Channels.
     *
     * @var \StadGent\Services\OpeningHours\Value\ChannelCollection
     */
    private ChannelCollection $channels;

    /**
     * Response Constructor.
     *
     * @param \StadGent\Services\OpeningHours\Value\ChannelCollection $channels
     */
    public function __construct(ChannelCollection $channels)
    {
        $this->channels = $channels;
    }

    /**
     * Get the Services.
     *
     * @return \StadGent\Services\OpeningHours\Value\ChannelCollection
     */
    public function getChannels(): ChannelCollection
    {
        return $this->channels;
    }
}
