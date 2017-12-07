<?php

namespace StadGent\Services\OpeningHours\Request;

use GuzzleHttp\Psr7\Request;

/**
 * Interface MailingList Request
 *
 * @package Gent\Services\MailingList\Request
 */
abstract class RequestAbstract extends Request implements RequestInterface
{
    /**
     * The accept header when creating the request.
     *
     * Default json.
     *
     * @var string
     */
    protected $headerAccept = AcceptType::JSON;

    /**
     * Constructor.
     *
     * @param string $uri
     *   The URI for the request object.
     */
    public function __construct($uri)
    {
        parent::__construct(
            MethodType::GET,
            $uri,
            ['Accept' => $this->headerAccept]
        );
    }
}
