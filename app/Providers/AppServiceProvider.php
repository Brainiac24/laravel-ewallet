<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Carbon::setLocale(config('app.locale'));

        if (\App::environment('local')) {

            //\Auth::loginUsingId('74016b8a-ba71-11e8-92b3-b06ebfbfa715');

            \DB::listen(function ($query) {
                \Log::info(
                    $query->sql,
                    $query->bindings,
                    $query->time
                );
            });
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
        //        $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
    }
}
