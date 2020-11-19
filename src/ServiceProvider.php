<?php

namespace DutchCodingCompany\CachedValuestore;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->app->singleton(CachedValuestore::class, static function (Application $app) {
            return CachedValuestore::make(CachedValuestore::$cachedFileName ?? $app->storagePath().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'settings.json');
        });
    }
}
