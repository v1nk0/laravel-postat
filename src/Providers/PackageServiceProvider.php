<?php

namespace V1nk0\LaravelPostat\Providers;

use Illuminate\Support\ServiceProvider;
use V1nk0\LaravelPostat\Plc;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('plc',function(){
            return new Plc();
        });
    }
}
