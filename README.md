# Get searchresults from a Google Custom Search Engine

[![Latest Version](https://img.shields.io/github/release/spatie/googlesearch.svg?style=flat-square)](https://github.com/spatie/googlesearch/releases)
[![Build status](https://img.shields.io/travis/spatie/googlesearch.svg)](https://travis-ci.org/spatie/googlesearch)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/9d5bf74c-2cc0-42bd-9800-5be2c2f034b7.svg)](https://insight.sensiolabs.com/projects/9d5bf74c-2cc0-42bd-9800-5be2c2f034b7)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/googlesearch.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/googlesearch)
[![StyleCI](https://styleci.io/repos/19391516/shield?branch=master)](https://styleci.io/repos/19391516)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/googlesearch.svg?style=flat-square)](https://packagist.org/packages/spatie/googlesearch)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This package can fetch results for the paid version of a Google Custom Search Engine. It returns an array with searchresults.
You'll need to know [how to set up a Google Custom Search Engine](https://support.google.com/customsearch/answer/2630963?hl=en).

Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Laravel compatibility

 Laravel  | googlesearch
:---------|:----------
 4.2.x    | 1.x
 5.x      | 2.x

## Postcardware

You're free to use this package (it's [MIT-licensed](LICENSE.md)), but if it makes it to your production environment you are required to send us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

The best postcards will get published on the open source page on our website.

## Installation

This package can be installed through Composer.

```bash
composer require spatie/googlesearch
```

When using Laravel there is a service provider that you can make use of.

```php

// Laravel 5: config/app.php

'providers' => [
    '...',
    'Spatie\GoogleSearch\GoogleSearchServiceProvider'
];
```

GoogleSearch also comes with a facade, which provides an easy way to call the the class.


```php

// Laravel 5: config/app.php

'aliases' => [
	...
	'GoogleSearch' => 'Spatie\GoogleSearch\Facades\GoogleSearch',
	...
]
```

You can publish the config file of the package using artisan

```bash
php artisan vendor:publish --provider="Spatie\GoogleSearch\GoogleSearchServiceProvider"
```

This command creates a file within your config directory in which you can specify the id of the Custom Search Engine you want to use.

## Usage

Here is a sample call to get search results:

```php
/* 
  This function returns an array with keys
  
  "name"     // the name of the found page
  "url"      // the url of the found page
  "snippet"  // a little piece of text found on the page
*/

$searchResults = GoogleSearch::getResults('The meaning of life'); // is 42
```

When no results are found an empty array is returned.

## About Spatie
Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).
