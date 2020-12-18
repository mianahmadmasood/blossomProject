<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SmsaSDK\Smsa;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot(UrlGenerator $url) {
        Smsa::key(env('SMSA_PASSKEY'));
        if (env('APP_ENV') === 'production' || env('APP_ENV') === 'production_v1'  ) {
            $url->forceScheme('http');
        }
    }

}
