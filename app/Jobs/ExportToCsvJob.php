<?php

namespace App\Jobs;

use App\Exports\ExporterCsvContract;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;

class ExportToCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $exporter;
    protected $filename;
    protected $jobHistoryId;
    protected $jobHistoryRepository;
    public $tries = 50;

    public function __construct(ExporterCsvContract $exporter, $filename, $jobHistoryId)
    {
        $this->exporter = $exporter;
        $this->filename = $filename;
        $this->jobHistoryId = $jobHistoryId;
        $this->jobHistoryRepository = \App::make(JobHistoryRepositoryContract::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '4096M');
        //before Job
        $this->jobHistoryRepository->update(["status" => 1, "payload" => $this->job->getRawBody() ,"processed_at" => Carbon::now()->format("Y-m-d H:i:s")], $this->jobHistoryId);

        //run
        $this->exporter->store($this->filename);

        //after Job
        $this->jobHistoryRepository->update(["status" => 2, "finished_at" => Carbon::now()->format("Y-m-d H:i:s")], $this->jobHistoryId);
    }

    public function failed(\Exception $exception)
    {
        $this->jobHistoryRepository
            ->update(["status" => -1, "finished_at" => Carbon::now()->format("Y-m-d H:i:s"),"error_message" => $exception->getMessage()],$this->jobHistoryId);
    }


}
