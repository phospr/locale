# Phospr\Locale

Simple PHP Locale ValueObject

## Usage

```
use Phospr\Locale;

echo Locale::fromString('en_US'); // en_US
echo Locale::fromCountrySlashLanguage('ca/fr'); // fr_CA

```

## Installation

```
composer require phospr/locale
```

#### Sources

Language data from http://stackoverflow.com/a/4900304

Country data from http://country.io/data/
