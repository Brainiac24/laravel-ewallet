<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 23.08.2021
 * Time: 16:12
 */

namespace App\Services\Backend\Web\UserHistory;


use App\Repositories\Backend\User\UserHistory\UserHistoryRepositoryContract;
use App\Repositories\Backend\User\UserHistoryDwh\UserHistoryDwhRepositoryContract;
use App\Services\Common\Helpers\DatabaseErrorCode;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class UserHistoryService implements UserHistoryServiceContract
{

    protected $userHistoryRepository;
    protected $userHistoryDwhRepository;
    private $logger;

    public function __construct(UserHistoryRepositoryContract $userHistoryRepositoryContract, UserHistoryDwhRepositoryContract $dwhRepositoryContract)
    {
        $this->userHistoryRepository = $userHistoryRepositoryContract;
        $this->userHistoryDwhRepository = $dwhRepositoryContract;
        $this->logger = new DwhRulesLogger();

    }

    public function copyToDwhAndRemoveOutdated($lifetimeInDays)
    {
        $removedCount = 0;
        $date = Carbon::now()->subDays($lifetimeInDays);
        $userHistories = $this->userHistoryRepository->recordsBeforeDate($date);

        foreach ($userHistories as $history){
            $shouldRemove = false;
            $newUserHistory = $this->arrayFill($history);
            try{
                $this->userHistoryDwhRepository->create($newUserHistory);
                $shouldRemove = true;

            }catch (QueryException $exception){
                $errorCode = $exception->errorInfo[1];
                if ($errorCode===DatabaseErrorCode::DUPLICATE_ENTRY_KEY){
                    $this->logger->warning('Duplicate entry key for user_history_dwh '.$history->id);
                    $shouldRemove = true;
                }else{
                    $this->logger->error($exception->getMessage());
                }
            }catch (\Exception $exception){
                $shouldRemove = false;
                $this->logger->error($exception->getMessage());
                $this->logger->error($exception->getTraceAsString());
            }

            if ($shouldRemove) {
                $history->delete();
                $removedCount++;
            }
        }
        $this->logger->info("Removed $removedCount  user_history which have $lifetimeInDays lifetime");

        return $removedCount;
    }

    private function arrayFill($history)
    {
        return [
            'id' => $history->id,
            'user_id' => $history->user_id,
            'event_id' => $history->event_id,
            'old_params_json' => $history->old_params_json,
            'new_params_json' => $history->new_params_json,
            'entity_type' => $history->entity_type,
            'entity_id' => $history->entity_id,
            'ip' => $history->ip,
            'description' => $history->description,
            'created_at' => $history->created_at,
            'updated_at' => $history->updated_at,
        ];
    }
}