<?php

namespace Tickit\CacheBundle\Tests\Util;

use Tickit\CacheBundle\Util\Sanitizer;
use PHPUnit_Framework_TestCase;

/**
 * Test suite for the FileSanitizer utility class
 *
 * @author James Halsall <james.t.halsall@googlemail.com>
 */
class SanitizerTest extends PHPUnit_Framework_TestCase
{

    /**
     * Makes sure that a valid identifier is properly accepted by the sanitizer
     */
    public function testSanitizeValidIdentifier()
    {
        $sanitizer = new Sanitizer();
        $id = $sanitizer->sanitizeIdentifier(1);

        $this->assertEquals(1, $id);
    }

    /**
     * Makes sure that an invalid identifier is properly sanitized
     */
    public function testSanitizeInvalidIdentifier()
    {
        $sanitizer = new Sanitizer();
        $id = $sanitizer->sanitizeIdentifier('1$*(%*(xx23');

        $this->assertEquals('1xx23', $id);
    }

    /**
     * Makes sure that upper and lower case letters are treated identically
     */
    public function testSanitizeCaseSensitivity()
    {
        $sanitizer = new Sanitizer();
        $id = $sanitizer->sanitizeIdentifier('1fFaD');

        $this->assertEquals('1fFaD', $id);
    }

    /**
     * Makes sure that the correct exception is thrown when passing an empty
     * identifier
     */
    public function testSanitizeEmptyIdentifier()
    {
        $caught = false;
        $sanitizer = new Sanitizer();

        try {
            $sanitizer->sanitizeIdentifier('');
        } catch (\InvalidArgumentException $e) {
            $caught = true;
        }

        $this->assertTrue($caught);
    }

    /**
     * Makes sure that path sanitization behaves as expected
     */
    public function testSanitizeRealPath()
    {
        $path = __DIR__ . '../../';
        $sanitizer = new Sanitizer();

        $sanitizedPath = $sanitizer->sanitizePath($path);

        $this->assertTrue(strpos($sanitizedPath, '..') === false);
    }

    /**
     * Makes sure that directory names are sanitized as expected
     */
    public function testSanitizeDirectoryName()
    {
        $directory = 'so"£$$mething"&"(£"&£("';
        $sanitizer = new Sanitizer();

        $sanitizedPath = $sanitizer->sanitizePath($directory, false);

        $this->assertEquals('something', $sanitizedPath);
    }
}