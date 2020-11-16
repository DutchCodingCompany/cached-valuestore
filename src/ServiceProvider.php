<?php

namespace DutchCodingCompany\CachedValuestore;

use Spatie\Valuestore\Valuestore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->app->singleton(Valuestore::class, static function (Application $app) {
            return CachedValuestore::make(CachedValuestore::$cachedFileName ?? $app->storagePath().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'settings.json');
        });
    }
}
