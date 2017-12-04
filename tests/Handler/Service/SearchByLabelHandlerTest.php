<?php

namespace StadGent\Services\Test\OpeningHours\Handler\Service;

use StadGent\Services\OpeningHours\Handler\Service\SearchByLabelHandler;
use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;
use PHPUnit\Framework\TestCase;

/**
 * Test the GetAllHandler.
 *
 * @package StadGent\Services\Test\OpeningHours\Handler\Service
 */
class SearchByLabelHandlerTest extends TestCase
{
    /**
     * Test the handles method.
     */
    public function testHandles()
    {
        $handler = new SearchByLabelHandler();
        $this->assertEquals(
            SearchByLabelRequest::class,
            $handler->handles(),
            'Handler only handles \StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest.'
        );
    }
}
