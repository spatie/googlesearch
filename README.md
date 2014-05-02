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

## Usage

coming soon...