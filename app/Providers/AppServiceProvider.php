<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => '34b8v43hr3pss5bm',
                    'publicKey' => '6992pvnstyf3hmrs',
                    'privateKey' => '0c563ce7e084be1faf02c4a7f3060905'
                ]
            );
        });

    }
}
