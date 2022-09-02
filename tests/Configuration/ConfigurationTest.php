<?php

namespace StadGent\Services\Test\OpeningHours\Client\Configuration;

use StadGent\Services\OpeningHours\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Test the Client/Configuration object.
 *
 * @package StadGent\Services\Test\OpeningHours\Client\Configuration
 */
class ConfigurationTest extends TestCase
{
    /**
     * Test constructor without key.
     */
    public function testConstructorWithoutKeyAndOptions()
    {
        $uri = 'https://test-endpoint.stad.gent';
        $configuration = new Configuration($uri);

        $this->assertEquals($uri, $configuration->getUri(), 'Uri is set.');
        $this->assertNull($configuration->getKey(), 'Key is by default null.');

        // Default options
        $this->assertEquals(
            20,
            $configuration->getTimeout(),
            'Default timeout is 20s.'
        );
    }

    /**
     * Test constructor with options.
     */
    public function testConstructorWithOptions()
    {
        $uri = 'https://test-endpoint.stad.gent';
        $key = 'foo-bar';
        $options = [
            'timeout' => 10,
        ];

        $configuration = new Configuration($uri, $key, $options);

        $this->assertEquals($uri, $configuration->getUri(), 'Uri is set.');
        $this->assertEquals($key, $configuration->getKey(), 'Key is set.');

        // Custom options
        $this->assertEquals(
            $options['timeout'],
            $configuration->getTimeout(),
            'Timeout is set to custom value.'
        );
    }
}
