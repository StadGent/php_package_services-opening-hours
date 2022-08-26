<?php

declare(strict_types=1);

namespace StadGent\Services\OpeningHours\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;

/**
 * Object containing the HTML response from the API.
 *
 * @package StadGent\Services\OpeningHours\Response
 */
final class HtmlResponse implements ResponseInterface
{
    /**
     * The HTML in the response.
     *
     * @var string
     */
    private string $html;

    /**
     * HtmlResponse constructor.
     *
     * @param string $html
     */
    public function __construct(string $html)
    {
        $this->html = $html;
    }

    /**
     * Get the HTML string.
     *
     * @return string
     *   The HTML string.
     */
    public function getHtml(): string
    {
        return $this->html;
    }
}
