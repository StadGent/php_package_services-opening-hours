<?php

namespace StadGent\Services\OpeningHours\Request\Service;

use StadGent\Services\OpeningHours\Request\MethodType;
use StadGent\Services\OpeningHours\Request\RequestAbstract;

/**
 * Request to get a Service by its ID.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
class GetByIdRequest extends RequestAbstract
{
    /**
     * @inheritDoc
     *
     * @param int $id
     *   The Service ID.
     */
    public function __construct($id)
    {
        $uri = sprintf('services/%d', $id);
        parent::__construct(
            MethodType::GET,
            $uri,
            ['Accept' => 'application/json']
        );
    }
}
