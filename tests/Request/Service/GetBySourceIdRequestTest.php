<?php

declare(strict_types=1);

namespace StadGent\Services\Test\OpeningHours\Request\Service;

use DigipolisGent\API\Client\Request\AcceptType;
use DigipolisGent\API\Client\Request\MethodType;
use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Request\Service\GetBySourceIdRequest;

/**
 * @covers \StadGent\Services\OpeningHours\Request\Service\GetBySourceIdRequest
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Service
 */
final class GetBySourceIdRequestTest extends TestCase
{
    /**
     * The request uses GET method.
     *
     * @test
     */
    public function itHasGetMethod(): void
    {
        $request = new GetBySourceIdRequest('source_name', 'source_id');
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * The endpoint includes the proper GET parameters
     *
     * @test
     */
    public function itHasProperGetParameter(): void
    {
        $request = new GetBySourceIdRequest('source_name', 'source_id');
        $this->assertEquals('services?source=source_name&sourceId=source_id', $request->getRequestTarget());
    }

    /**
     * We only accept JSON responses.
     */
    public function itHasJsonAcceptType(): void
    {
        $request = new GetBySourceIdRequest('source_name', 'source_id');
        $this->assertEquals(AcceptType::JSON, $request->getHeaderLine('Accept'));
    }
}
