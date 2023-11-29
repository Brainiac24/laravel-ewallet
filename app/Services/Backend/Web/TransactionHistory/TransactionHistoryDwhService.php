<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 27.08.2021
 * Time: 13:49
 */

namespace App\Services\Backend\Web\TransactionHistory;


use App\Repositories\Backend\Transaction\TransactionHistoryDwh\TransactionHistoryDwhRepositoryContract;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TransactionHistoryDwhService implements TransactionHistoryDwhServiceContract
{
    protected $transactionHistoryDwhRepository;

    private $logger;

    public function __construct(TransactionHistoryDwhRepositoryContract $dwhRepositoryContract)
    {
        $this->transactionHistoryDwhRepository = $dwhRepositoryContract;
        $this->logger = new DwhRulesLogger();
    }

    public function findAndRemoveOutdatedDwh($lifetimeInDays)
    {
        $removedCount = 0;
        $date = Carbon::now()->subDays($lifetimeInDays)->format('Y-m-d 00:00:00');
        $transactionHistories = $this->transactionHistoryDwhRepository->recordsBeforeDate($date);

        foreach ($transactionHistories as $history){
            $history->delete();
            $removedCount++;
        }
        $this->logger->info("Removed $removedCount  transaction_history_dwh which have $lifetimeInDays lifetime");

        return $removedCount;
    }
}