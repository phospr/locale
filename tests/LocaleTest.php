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
     * Test format
     *
     * @author Christopher Tatro <c.m.tatro@gmail.com>
     * @since  1.0.0
     *
     * @dataProvider formatProvider
     */
    public function testFormat($locale, $format, $expected)
    {
        $this->assertSame($expected, $locale->format($format));
    }

    /**
     * format Provider
     *
     * @author Christopher Tatro <c.m.tatro@gmail.com>
     * @since  1.0.0
     *
     * @return array
     */
    public static function formatProvider()
    {
        return [
            [Locale::fromString('en_us'), '%c_%L', 'us_EN'],
            [Locale::fromString('en_CA'), '%C_%L', 'CA_EN'],
            [Locale::fromString('en_US'), '%c_%l', 'us_en'],
            [Locale::fromString('EN_US'), '%c/%L', 'us/EN'],
            [Locale::fromString('Es_mx'), '%C\%%L', 'MX%ES'],
            [Locale::fromString('eN_uS'), '%C\%L', 'US%L'],
            [Locale::fromString('en_us'), '%C\\\%L', 'US\EN'],
            [Locale::fromString('en_Gb'), '%C\\:%L', 'GB:EN'],
            [Locale::fromString('ru_RU'), '%C:%L', 'RU:RU'],
            [Locale::fromString('en_us'), '%C\:%L', 'US:EN']
        ];
    }

    /**
     * Test formatException
     *
     * @author Christopher Tatro <c.m.tatro@gmail.com>
     * @since  1.0.0
     *
     * @expectedException InvalidArgumentException
     *
     * @dataProvider formatExceptionProvider
     */
    public function testFormatException($locale, $format)
    {
        $this->assertSame($locale->format($format));
    }

    /**
     * formatException Provider
     *
     * @author Christopher Tatro <c.m.tatro@gmail.com>
     * @since  1.0.0
     *
     * @return array
     */
    public static function formatExceptionProvider()
    {
        return [
            [Locale::fromString('ru_RU'), '%S_%L'],
            [Locale::fromString('en_us'), '%C_%r'],
            [Locale::fromString('en_us'), '%Cr%a'],
            [Locale::fromString('en_us'), '%c_%J'],
            [Locale::fromString('en_us'), '%\%/%L'],
            [Locale::fromString('en_GB'), '%\%/%L'],
            [Locale::fromString('en_AU'), '%\%/%L'],
            [Locale::fromString('en_us'), 123432],
            [Locale::fromString('en_us'), ['can', 'do', 'this']]
        ];
    }
}
