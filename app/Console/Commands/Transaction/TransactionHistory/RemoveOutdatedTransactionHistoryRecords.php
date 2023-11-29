<?php

namespace App\Console\Commands\Transaction\TransactionHistory;

use App\Repositories\Backend\DwhRule\DwhRuleRepositoryContract;
use App\Services\Backend\Web\TransactionHistory\TransactionHistoryServiceContract;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveOutdatedTransactionHistoryRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction_history:remove_outdated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $transactionHistoryService;
    private $dwhRuleRepository;
    private $logger;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->transactionHistoryService = app()->make(TransactionHistoryServiceContract::class);
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
        $this->logger->info('handling remove outdated transaction history records');
        $startTime = Carbon::now();
        $userHistoryRule = $this->dwhRuleRepository->getAllByTable('transaction_histories')->first();
        $lifetimeInDays = $userHistoryRule->to_dwh_days ?? null;
        if(isset($lifetimeInDays)){
            $this->transactionHistoryService->copyToDwhAndRemoveOutdated($lifetimeInDays);
             $this->logger->info("task completed in ".Carbon::now()->diffInMinutes($startTime)." minutes");
        }else{
            $this->logger->warning("dwh rule for transaction history is not set");
        }

    }
}
