<?php

namespace App\Services\Common\Gateway\Queue;

use Illuminate\Support\ServiceProvider;
use App\Services\Common\Gateway\Queue\QueueTransporterContract;
use App\Services\Common\Gateway\Queue\QueueTransporter;

class QueueServiceProvider extends ServiceProvider
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
        $this->app->bind(QueueTransporterContract::class, QueueTransporter::class);
        $this->app->bind(QueueHashContract::class, QueueHash::class);
    }
}
