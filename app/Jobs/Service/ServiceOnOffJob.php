<?php

namespace App\Jobs\Service;

use App\Repositories\Backend\Service\ServiceRepositoryContract;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ServiceOnOffJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    public $tries = 50;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data=[])
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $serviceRepository = \App::make(ServiceRepositoryContract::class);
        $serviceRepository->onOff($this->data['is_active'], $this->data['service_id']);
    }
}
