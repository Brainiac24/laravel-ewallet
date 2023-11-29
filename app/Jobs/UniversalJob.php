<?php

namespace App\Jobs;

use App\Services\Common\Helpers\ScheduleType;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class UniversalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $schedule_id;
    protected $schedule_type;
    protected $schedule_value;

    public $tries = 10;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($schedule_id, $schedule_type, $schedule_value)
    {
        $this->schedule_id = $schedule_id;
        $this->schedule_type = $schedule_type;
        $this->schedule_value = $schedule_value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if (strtolower($this->schedule_type) == strtolower(ScheduleType::COMMAND)) {
                $obj = new $this->schedule_value();
                Log::info('scheduled job is type of Command');
                $obj->handle();
            } elseif (strtolower($this->schedule_type) == strtolower(ScheduleType::JOB)) {
                $obj = new $this->schedule_value();
                Log::info('scheduled job is type of Job');
                if ($obj instanceof ShouldQueue) {
                    dispatch($obj)->onQueue('scheduler_jobs');
                }
//
            }
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            \Log::error($ex->getTraceAsString());
        }
    }
}
