<?php

namespace App\Console\Commands\UserHistory;

use App\Repositories\Backend\DwhRule\DwhRuleRepositoryContract;
use App\Services\Backend\Web\UserHistory\UserHistoryServiceContract;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveOutdatedUserHistoryRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user_history:remove_outdated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Select outdated data from user_histories and move them to user_histories_dwh';

    private $userHistoryService;
    private $dwhRuleRepository;
    private $logger;
    /**
     * Create a new command instance.
     *
     * @param $serviceContract UserHistoryServiceContract
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->userHistoryService = app()->make(UserHistoryServiceContract::class);
        $this->dwhRuleRepository = app()->make(DwhRuleRepositoryContract::class);
        $this->logger = new DwhRulesLogger();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->logger->info('handling remove outdated user history records');
        $startTime = Carbon::now();
        $userHistoryRule = $this->dwhRuleRepository->getAllByTable('user_histories')->first();
        $lifetimeInDays = $userHistoryRule->to_dwh_days ?? null;
        if (isset($lifetimeInDays)){
            $this->userHistoryService->copyToDwhAndRemoveOutdated($lifetimeInDays);
            $this->logger->info("task completed in ".Carbon::now()->diffInMinutes($startTime)." minutes");
        }else{
            $this->logger->warning("dwh rule for table user_histories not set");
        }

    }
}
