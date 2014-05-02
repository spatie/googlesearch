<?php namespace Spatie\GoogleSearch;
use Illuminate\Support\ServiceProvider;
use Config;

class GoogleSearchServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('googleSearch', function()
        {
            return new GoogleSearch(Config::get('googleSearch.searchEngineId'));
        });
    }

}