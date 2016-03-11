<?php

/*
 * This file is part of the Phospr Locale package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phospr;

/**
 * A Value Object representation of 5 character locale string:
 *
 *     * en_US
 *     * fr_FR
 *     * en_GB
 *     * etc
 *
 * @author Tom Haskins-Vaughan <tom@tomhv.uk>
 * @since  1.0.0
 */
class Locale
{
    /**
     * languageCode
     *
     * @var string
     */
    private $languageCode;

    /**
     * countryCode
     *
     * @var string
     */
    private $countryCode;

    /**
     * Constructor
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     *
     * @param string $languageCode
     * @param string $countryCode
     */
    private function __construct($languageCode, $countryCode)
    {
        $this->languageCode = strtolower($languageCode);
        $this->countryCode = strtoupper($countryCode);
    }

    /**
     * To string
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '%s_%s',
            $this->languageCode,
            $this->countryCode
        );
    }

    /**
     * Get countryCode
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Get languageCode
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     *
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * Compares two Locales
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     *
     * @param Locale $other
     *
     * @return bool
     */
    public function isSameValueAs(Locale $other)
    {
        return
            $this->languageCode == $other->languageCode &&
            $this->countryCode == $other->countryCode
        ;
    }

    /**
     * From string
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     *
     * @param string $localeAsString
     *
     * @return Locale
     */
    public static function fromString($localeAsString)
    {
        $segments = explode('_', $localeAsString);

        return new static($segments[0], $segments[1]);
    }

    /**
     * From countryCode/languageCode
     *
     * @author Tom Haskins-Vaughan <tom@tomhv.uk>
     * @since  1.0.0
     *
     * @param string $countrySlashLanguage
     *
     * @return Locale
     */
    public static function fromCountrySlashLanguage($countrySlashLanguage)
    {
        $segments = explode('/', $countrySlashLanguage);

        return new static($segments[1], $segments[0]);
    }

    /**
     * To countryCode/languageCode
     *
     * @author Christopher Tatro <c.m.tatro@gmail.com>
     * @since  1.0.0
     *
     * @return string countryCode/languageCode
     */
    public function toCountrySlashLanguage()
    {
        return sprintf(
            '%s/%s',
            $this->getCountryCode(),
            $this->getLanguageCode()
        );
    }
}
