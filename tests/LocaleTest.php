<?php

/*
 * This file is part of the Phospr Locale package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phospr\Tests\Locale;

use Phospr\Locale;
use PHPUnit_Framework_TestCase;

/**
 * LocaleTest
 *
 * @author Tom Haskins-Vaughan <tom@tomhv.uk>
 * @since  1.0.0
 */
class LocaleTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test fromString
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     */
    public function testFromString()
    {
        $locale = Locale::fromString('en_US');

        $this->assertSame('US', $locale->getCountryCode());
        $this->assertSame('en', $locale->getLanguageCode());
    }

    /**
     * Test fromCountrySlashLanguage
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     */
    public function testFromCountrySlashLanguage()
    {
        $locale = Locale::fromCountrySlashLanguage('us/en');

        $this->assertSame('US', $locale->getCountryCode());
        $this->assertSame('en', $locale->getLanguageCode());
    }

    /**
     * Test __toString
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     */
    public function testToString()
    {
        $locale = Locale::fromString('eN_uS');

        $this->assertSame('en_US', (string) $locale);
    }

    /**
     * Test isSameValueAs
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     */
    public function testIsSameValueAs()
    {
        $locale = Locale::fromString('eN_uS');
        $other = Locale::fromString('EN_Us');
        $yetAnother = Locale::fromString('Es_Us');

        $this->assertTrue($locale->isSameValueAs($other));
        $this->assertFalse($locale->isSameValueAs($yetAnother));
    }

    /**
     * Test fromCountrySlashLanguage
     *
     * @author Christopher Tatro <c.m.tatro@gmail.com>
     * @since  1.0.0
     */
    public function testToCountrySlashLanguage()
    {
        $locale = Locale::fromCountrySlashLanguage('us/en');

        $this->assertSame('US/en', $locale->toCountrySlashLanguage());
    }
}
