<?php

declare(strict_types=1);

namespace StadGent\Services\Test\OpeningHours\Uri\Service;

use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Uri\Service\GetBySourceIdUri;

/**
 * @covers \StadGent\Services\OpeningHours\Uri\Service\GetBySourceIdUri
 *
 * @package StadGent\Services\Test\OpeningHours
 */
final class GetBySourceIdUriTest extends TestCase
{
    /**
     * The URI should contain the source and source id values.
     *
     * @test
     */
    public function testConstruct(): void
    {
        $uri = new GetBySourceIdUri('source_name', 'source_id');

        $expected = 'services?source=source_name&sourceId=source_id';
        $this->assertEquals($expected, $uri->getUri());
    }
}
