<?php

namespace App\Jobs\CardType;

use App\Repositories\Backend\OrderCardType\OrderCardTypeRepositoryContract;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CardTypeOnOffJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $params;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cardTypeRepository = \App::make(OrderCardTypeRepositoryContract::class);
        $cardTypeRepository->onOff($this->params['is_active'], $this->params['card_type_id']);
    }
}
