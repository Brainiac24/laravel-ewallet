<?php

namespace App\Console\Commands\JobLogs;


use App\Services\Backend\Web\DwgRule\DwhRuleServiceContract;
use App\Services\Backend\Web\JobLog\JobLogServiceContract;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveOutdatedJobLogRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job_log:remove_outdated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove outdated job logs';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $jobLogService;
    private $dwhRulesService;
    private $logger;
    public function __construct()
    {
        parent::__construct();
        $this->jobLogService = app()->make(JobLogServiceContract::class);
        $this->dwhRulesService = app()->make(DwhRuleServiceContract::class);
        $this->logger = new DwhRulesLogger();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startTime = Carbon::now();
        $this->logger->info('handling remove job logs');
        $groupedRules = $this->dwhRulesService->jobLogRulesGroupedToDwh();
        if(!count($groupedRules)){
            $this->logger->info('There is no rules for job_logs table');
        }else{
            foreach ($groupedRules as $lifetimeInDays => $groupedRule) {
                $this->jobLogService->copyToDwhAndRemoveOutdated($lifetimeInDays,$groupedRule);
            }

            $this->logger->info("task completed in ".Carbon::now()->diffInMinutes($startTime)." minutes");
        }



    }

}
