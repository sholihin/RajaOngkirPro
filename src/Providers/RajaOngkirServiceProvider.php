<?php

namespace Sholihin\RajaOngkirPro\Providers;

use Illuminate\Support\ServiceProvider;

class RajaOngkirServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('rajaOngkir', \Sholihin\RajaOngkirPro\Helpers\RajaOngkir::class);
    }

    public function boot()
    {

    }
}