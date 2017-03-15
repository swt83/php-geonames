# zip2city

A PHP library for converting zip codes to city and state.

Uses the Geonames (database)[http://download.geonames.org/export/zip/] file.

## Install

Normal install via composer.

## Usage

```php
// load the database
$geonames = new Travis\Geonames;

// find the answer
$response = $geonames->get(22202);
```

Will return an array like this:

```
Array
(
    [country] => US
    [zip] => 22202
    [city] => Arlington
    [state_long] => Virginia
    [state_short] => VA
)
```

This is only designed for the United States.