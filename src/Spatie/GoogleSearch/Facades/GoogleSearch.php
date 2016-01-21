<?php

namespace Spatie\GoogleSearch\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleSearch extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'googleSearch';
    }
}
