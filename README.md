# Phospr\Locale

[![Build Status](https://travis-ci.org/phospr/locale.svg)](https://travis-ci.org/phospr/locale)
[![Coverage Status](https://coveralls.io/repos/github/phospr/locale/badge.svg)](https://coveralls.io/github/phospr/locale)

Simple PHP Locale ValueObject

## Usage

```
use Phospr\Locale;

echo Locale::fromString('en_US'); // en_US
echo Locale::fromCountrySlashLanguage('ca/fr'); // fr_CA

```

### Formatting

Use:

- `%L` For uppercase language code
- `%l` For lowercase language code
- `%C` For uppercase country code
- `%c` For lowercase country code

Note:

- any other combination of %{:char:} will throw an InvalidArgumentException unless the % is escaped with \
- to get a \ You will need to double escape ( \\\ )

Examples:

```php
echo Locale::fromString('se_FI')->format('%L_%c'); // SE_fi
echo Locale::fromString('se_FI')->format('%C/%s'); // FI/se
echo Locale::fromString('se_FI')->format('%c/%s'); // fi/se
echo Locale::fromString('se_FI')->format('%c\\\%s'); // fi\se
```

## Installation

```
composer require phospr/locale
```

#### Sources

Language data from http://stackoverflow.com/a/4900304

Country data from http://country.io/data/
