<?php

namespace StadGent\Services\OpeningHours\Handler;

use Psr\Http\Message as Psr;
use StadGent\Services\OpeningHours\Response\Exception\InvalidResponseException;

/**
 * Abstract base Handler.
 *
 * @package StadGent\Services\OpeningHours\Handler
 */
abstract class HandlerAbstract implements HandlerInterface
{
    /**
     * Validate and throw the proper exception if not a 200 response.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *   The response object to validate.
     * @param \StadGent\Services\OpeningHours\Response\Validator\ValidatorInterface[] $validators
     *   Optional array of validators.
     *
     * @throws \StadGent\Services\OpeningHours\Response\Exception\InvalidResponseException
     *   When the response is not catched by other specific validators.
     */
    protected function validateResponse(Psr\ResponseInterface $response, array $validators = [])
    {
        if ($response->getStatusCode() === 200) {
            return;
        }

        // Loop over the validators.
        // If one of them validates as valid => stop validating.
        foreach ($validators as $validator) {
            if ($validator->validate($response)) {
                return;
            }
        }

        // Default Exception.
        throw InvalidResponseException::fromResponse($response);
    }

    /**
     * Get the array version of the response body.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    protected function getBodyData(Psr\ResponseInterface $response)
    {
        $raw = (string) $response->getBody();
        return json_decode($raw, true);
    }
}
