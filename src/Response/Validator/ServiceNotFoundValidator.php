<?php

namespace StadGent\Services\OpeningHours\Response\Validator;

use Psr\Http\Message as Psr;
use StadGent\Services\OpeningHours\Response\Exception\ServiceNotFoundException;

class ServiceNotFoundValidator implements ValidatorInterface
{
    /**
     * Throw exception if the status code is 404 or 422.
     *
     * @inheritdoc
     *
     * @throws \StadGent\Services\OpeningHours\Response\Exception\ServiceNotFoundException
     */
    public function validate(Psr\ResponseInterface $response)
    {
        $codes = [404, 422];
        if (in_array($response->getStatusCode(), $codes, true)) {
            throw ServiceNotFoundException::fromResponse($response);
        }
    }
}
