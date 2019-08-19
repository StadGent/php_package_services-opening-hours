<?php

namespace StadGent\Services\OpeningHours\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;

/**
 * Object containing the HTML response from the API.
 *
 * @package StadGent\Services\OpeningHours\Response
 */
class HtmlResponse implements ResponseInterface
{
    /**
     * The HTML in the response.
     *
     * @var string
     */
    private $html;

    /**
     * HtmlResponse constructor.
     *
     * @param string $html
     */
    public function __construct($html)
    {
        $this->html = $html;
    }

    /**
     * Get the HTML string.
     *
     * @return string
     *   The HTML string.
     */
    public function getHtml()
    {
        return $this->html;
    }
}
