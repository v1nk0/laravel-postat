<?php

namespace V1nk0\LaravelPostat\Providers;

use Illuminate\Support\ServiceProvider;
use V1nk0\LaravelPostat\Plc;
use V1nk0\LaravelPostat\Tracking;

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
        $this->app->bind('postat.plc',function(){
            return new Plc();
        });

        $this->app->bind('postat.tracking',function(){
            return new Tracking();
        });
    }
}
