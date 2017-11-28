<?php

namespace StadGent\Services\OpeningHours\Client\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Class InvalidResponse
 *
 * @package StadGent\Services\OpeningHours\Client\Exception
 */
class InvalidResponse extends Exception
{
    /**
     * @var array
     */
    private $data;

    /**
     * InvalidResponse constructor.
     *
     * @param string $message
     * @param array $data
     */
    public function __construct($message, array $data = [])
    {
        $this->data = $data;
        parent::__construct($message);
    }

    /**
     * Generates an Exception with a uniform message
     *
     * @param ResponseInterface $response
     * @return static
     */
    public static function fromResponse(ResponseInterface $response)
    {
        $body = (string)$response->getBody();
        $data = json_decode($body, true);

         return new static(
             sprintf(
                'Response with status code %s was unexpected : \'%s\'',
                $response->getStatusCode(),
                $body
             ),
             $data
         );
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
