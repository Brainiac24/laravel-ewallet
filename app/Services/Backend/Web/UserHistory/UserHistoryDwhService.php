<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 27.08.2021
 * Time: 13:13
 */

namespace App\Services\Backend\Web\UserHistory;

use App\Repositories\Backend\User\UserHistoryDwh\UserHistoryDwhRepositoryContract;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserHistoryDwhService implements UserHistoryDwhServiceContract
{
    protected $userHistoryDwhRepository;

    private $logger;

    public function __construct(UserHistoryDwhRepositoryContract $dwhRepositoryContract)
    {
        $this->userHistoryDwhRepository = $dwhRepositoryContract;
        $this->logger = new DwhRulesLogger();

    }

    public function findAndRemoveOutdatedDwh($lifetimeInDays)
    {
        $removedCount = 0;
        $date = Carbon::now()->subDays($lifetimeInDays)->format('Y-m-d 00:00:00');
        $userHistories = $this->userHistoryDwhRepository->recordsBeforeDate($date);

        foreach ($userHistories as $history) {
            $history->delete();
            $removedCount++;
        }
        $this->logger->info("Removed $removedCount  user_history_dwh which have $lifetimeInDays lifetime");

        return $removedCount;
    }
}