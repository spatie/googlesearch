# Get searchresults from a Google Custom Search Engine

[![Build Status](https://secure.travis-ci.org/freekmurze/googlesearch.png)](http://travis-ci.org/freekmurze/googlesearch)
[![Latest Stable Version](https://poser.pugx.org/spatie/googlesearch/version.png)](https://packagist.org/packages/spatie/googlesearch)
[![License](https://poser.pugx.org/spatie/googlesearch/license.png)](https://packagist.org/packages/spatie/googlesearch)

This package can fetch results from a Google Custom Search Engine. It returns an array with searchresults.
You'll need to know [how to set up a Google Custom Search Engine](https://support.google.com/customsearch/answer/2630963?hl=en).

## Installation

This package can be installed through Composer.

```
composer require spatie/googlesearch
```

When using Laravel there is a service provider that you can make use of.

```php

// app/config/app.php

'providers' => [
    '...',
    'Spatie\GoogleSearch\GoogleSearchServiceProvider'
];
```

GoogleSearch also comes with a facade, which provides an easy way to call the the class.


```php

// app/config/app.php

'aliases' => array(
	...
	'GoogleSearch' => 'Spatie\GoogleSearch\Facades\GoogleSearch',
)
```

You can publish the config file of the package using artisan

```bash
php artisan config:publish spatie/googlesearch
```

This command creates a file within your app/config directory in which you can specify the id of the Custom Search Engine you want to use.

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
