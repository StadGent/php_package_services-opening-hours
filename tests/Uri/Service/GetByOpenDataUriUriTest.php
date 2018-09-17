<?php

namespace StadGent\Services\Test\OpeningHours\Uri\Service;

use PHPUnit\Framework\TestCase;
use StadGent\Services\OpeningHours\Uri\Service\GetByOpenDataUriUri;

/**
 * Tests for GetByOpenDataUriUri.
 *
 * @package StadGent\Services\Test\OpeningHours
 *
 * @covers \StadGent\Services\OpeningHours\Uri\Service\GetByOpenDataUriUri
 */
class GetByOpenDataUriUriTest extends TestCase
{
    /**
     * Test the URI constructor.
     */
    public function testConstruct()
    {
        $uri = 'https://stad.gent/id/agents/abcde1234567890';
        $uriUri = new GetByOpenDataUriUri($uri);

        $expected = 'services?uri=' . $uri;
        $this->assertEquals($expected, $uriUri->getUri());
    }
}
