# Get searchresults from a Google Custom Search Engine

[![Build Status](https://secure.travis-ci.org/freekmurze/googlesearch.png)](http://travis-ci.org/freekmurze/googlesearch)
[![Latest Stable Version](https://poser.pugx.org/spatie/googlesearch/version.png)](https://packagist.org/packages/spatie/googlesearch)
[![License](https://poser.pugx.org/spatie/googlesearch/license.png)](https://packagist.org/packages/spatie/googlesearch)


## Installation

This package can be installed through Composer.

```js
{
    "require": {
		"spatie/googlesearch": "dev-master"
	}
}
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
	'GoogleSearch' => 'Spatie\GoogleSearch\GoogleSearchFacade',
)
```

You can publish the config file of the package using artisan

```bash
php artisan config:publish spatie/googlesearch
```

This command creates a file within your app/config directory in which you can specify the id of the Custom Search Engine you want to use.

## Usage

coming soon...
