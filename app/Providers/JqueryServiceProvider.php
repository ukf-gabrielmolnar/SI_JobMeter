<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class JqueryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../vendor/bower-asset/jquery/dist' => public_path('vendor/jquery'),
        ], 'public');
    }
}
