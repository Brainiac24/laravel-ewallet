<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\Common\EwalletApi\EwalletApiClientService;
use App\Services\Common\EwalletApi\EwalletApiClientServiceContract;

class HttpClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EwalletApiClientServiceContract::class, EwalletApiClientService::class);
    }
}
