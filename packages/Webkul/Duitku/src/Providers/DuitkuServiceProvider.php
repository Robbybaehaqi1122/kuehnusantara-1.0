<?php

namespace Webkul\Duitku\Providers;

use Illuminate\Support\ServiceProvider;

class DuitkuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerConfig();
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/..Http/routes.php');
        $this->mergeConfigFrom(
            dirname(__DIR__).'/Config/paymentmethods.php', 'payment_methods'
        );
    }

    protected function registerConfig()
    {
        // merged in boot
    }
}
