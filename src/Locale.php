<?php

/*
 * This file is part of the Phospr Locale package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phospr;

use InvalidArgumentException;

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
     * Format Locale as string
     *
     * echo Locale::fromString('se_FI')->format('%L_%c'); // SE_fi
     * echo Locale::fromString('se_FI')->format('%C/%s'); // FI/se
     * echo Locale::fromString('se_FI')->format('%c/%s'); // fi/se
     * echo Locale::fromString('se_FI')->format('%c\\\%s'); // fi\se
     *
     * Current translattable codes are:
     *
     *   * %L For uppercase language code
     *   * %l For lowercase language code
     *   * %C For uppercase country code
     *   * %c For lowercase country code
     *   * any other combination of %{:char:} will throw an
     *     Invalid argument exception unless the % is escaped with \
     *   * To get a \ You will need to double escape ( \\\ )
     *
     * @author Christopher Tatro <c.m.tatro@gmail.com>
     * @since  1.0.0
     *
     * @param string $format
     *
     * @return string
     */
    public function format($format)
    {
        if (!is_string($format)) {
            throw new InvalidArgumentException(sprintf(
                'format passed must be a string'
            ));
        }

        $translateNext = false;
        $escNext = false;
        $formatted = '';
        foreach (str_split($format) as $char) {
            if ($escNext) {
                $formatted .= $char;
                $escNext = false;
                continue;
            }

            if ($translateNext) {
                switch ($char) {
                    case 'c':
                        $translated = strtolower($this->getCountryCode());
                        break;
                    case 'C':
                        $translated = strtoupper($this->getCountryCode());
                        break;
                    case 'l':
                        $translated = strtolower($this->getLanguageCode());
                        break;
                    case 'L':
                        $translated = strtoupper($this->getLanguageCode());
                        break;
                    default:
                        throw new InvalidArgumentException(sprintf(
                            'Unkown format'
                        ));
                }

                $formatted .= $translated;
                $translateNext = false;
                continue;
            }

            if ('\\' == $char) {
                $escNext = true;
                continue;
            } elseif ('%' == $char) {
                $translateNext = true;
                continue;
            }

            $formatted .= $char;
        }

        return $formatted;
    }
}
