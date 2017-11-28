<?php

namespace StadGent\Services\OpeningHours\Response\Validator;

use Psr\Http\Message as Psr;

/**
 * Interface to validate response objects.
 */
interface ValidatorInterface
{
    /**
     * Validate the response object.
     *
     * Will throw a specific exception if the validation fails.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function validate(Psr\ResponseInterface $response);
}
