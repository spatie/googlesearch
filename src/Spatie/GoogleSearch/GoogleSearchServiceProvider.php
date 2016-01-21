<?php

namespace Spatie\GoogleSearch;

use Illuminate\Support\ServiceProvider;

class GoogleSearchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/googleSearch.php' => config_path('googleSearch.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind('googleSearch', function () {
            $googlesearchConfig = config('googleSearch');

            return new GoogleSearch($googlesearchConfig['searchEngineId']);
        });
    }
}
