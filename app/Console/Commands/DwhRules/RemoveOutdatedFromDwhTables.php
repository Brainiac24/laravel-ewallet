<?php

namespace App\Console\Commands\DwhRules;

use App\Services\Backend\Web\DwgRule\DwhRuleServiceContract;
use App\Services\Backend\Web\JobLog\JobLogDwhServiceContract;
use App\Services\Backend\Web\TransactionHistory\TransactionHistoryDwhServiceContract;
use App\Services\Backend\Web\UserHistory\UserHistoryDwhServiceContract;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RemoveOutdatedFromDwhTables extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dwh_tables:remove_outdated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    private $dwhRulesService;

    private $userHistoryDwhService;

    private $transactionHistoryDwhService;

    private $jobLogDwhService;
    private $logger;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->dwhRulesService = app()->make(DwhRuleServiceContract::class);
        $this->userHistoryDwhService = app()->make(UserHistoryDwhServiceContract::class);
        $this->transactionHistoryDwhService = app()->make(TransactionHistoryDwhServiceContract::class);
        $this->jobLogDwhService = app()->make(JobLogDwhServiceContract::class);
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
       $this->logger->info('handling remove from dwh tables');
        $userHistoryRule = $this->dwhRulesService->userHistoryDwhRule();
        $transactionHistoryRule = $this->dwhRulesService->transactionHistoryDwhRule();

        if($userHistoryRule->delete_from_dwh_days){
            $this->userHistoryDwhService->findAndRemoveOutdatedDwh($userHistoryRule->delete_from_dwh_days);
        }

        if($transactionHistoryRule->delete_from_dwh_days){
            $this->transactionHistoryDwhService->findAndRemoveOutdatedDwh($transactionHistoryRule->delete_from_dwh_days);
        }

        $this->jobLogDwhService->findAndRemoveOutdatedDwh();

        $this->logger->info("task completed in ".Carbon::now()->diffInMinutes($startTime)." minutes");
    }
}
