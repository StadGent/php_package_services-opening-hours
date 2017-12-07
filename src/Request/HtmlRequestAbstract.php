<?php

namespace StadGent\Services\OpeningHours\Request;

use GuzzleHttp\Psr7\Request;
use StadGent\Services\OpeningHours\Uri\UriInterface;

/**
 * Abstract request requesting HTML response.
 *
 * @package Gent\Services\MailingList\Request
 */
abstract class HtmlRequestAbstract extends Request implements RequestInterface
{
    /**
     * Constructor.
     *
     * @param \StadGent\Services\OpeningHours\Uri\UriInterface $uri
     *   The URI for the request object.
     */
    public function __construct(UriInterface $uri)
    {
        parent::__construct(
            MethodType::GET,
            $uri->getUri(),
            ['Accept' => AcceptType::HTML]
        );
    }
}
