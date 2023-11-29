<?php

namespace App\Console\Commands;

use App\Jobs\UniversalJob;
use App\Models\Schedule\Schedule;
use Cron\CronExpression;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ProcessScheduleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $schedule;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->schedule = new Schedule();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now()->toDateTimeString();
        $this->schedule->with('scheduleType')->where('is_active', 1)->each(function ($item) use ($date){
            if (CronExpression::factory($item->cron_expression)->isDue($date)){

                UniversalJob::dispatch($item->id, $item->scheduleType->type, $item->scheduleType->value)->onQueue('scheduler');
                Log::info('its time to cron job because of due expression scheduleType.id=' .$item->id);

            }
        }, 1000);
    }
}
