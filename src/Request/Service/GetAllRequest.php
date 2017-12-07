<?php

namespace StadGent\Services\OpeningHours\Request\Service;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\MethodType;
use StadGent\Services\OpeningHours\Request\RequestAbstract;

/**
 * Request to get all Services.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
class GetAllRequest extends RequestAbstract
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct('services');
    }
}
