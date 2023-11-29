<?php

namespace App\Jobs\Gateway;

use App\Repositories\Backend\Gateway\GatewayRepositoryContract;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GatewayOnOffJob implements ShouldQueue
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
        $gatewayRepository = \App::make(GatewayRepositoryContract::class);
        $gatewayRepository->onOff($this->data['is_active'], $this->data['gateway_id']);
    }
}
