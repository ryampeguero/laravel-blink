<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Gateway::class ,  function ($app) {
            return new Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchant_id'),
                'publicKey' => config('services.braintree.public_key'),
                'privateKey' => config('services.braintree.private_key'),
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
