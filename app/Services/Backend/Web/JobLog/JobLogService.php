<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 20.08.2021
 * Time: 11:33
 */

namespace App\Services\Backend\Web\JobLog;


use App\Repositories\Backend\JobLog\JobLogDwhRepositoryContract;
use App\Repositories\Backend\JobLog\JobLogRepositoryContract;
use App\Services\Common\Helpers\DatabaseErrorCode;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class JobLogService implements JobLogServiceContract
{
    private $jobLogRepository;
    private $jobLogDwhRepository;
    private $logger;

    public function __construct(JobLogRepositoryContract $jobLogRepositoryContract, JobLogDwhRepositoryContract $dwhRepositoryContract)
    {
        $this->jobLogRepository = $jobLogRepositoryContract;
        $this->jobLogDwhRepository = $dwhRepositoryContract;
        $this->logger = new DwhRulesLogger();
    }

    public function copyToDwhAndRemoveOutdated($lifetimeInDays, $groupedJobTypes)
    {
        $date = Carbon::now()->subDays($lifetimeInDays);

        $jobLogs = $this->jobLogRepository->recordsBeforeDate($date->format('Y-m-d 00:00:00'),$groupedJobTypes);

        $removedCount = 0;
        foreach ($jobLogs as $jobLog) {
            $shouldRemove = false;
            $arrayJobLog = $this->arrayFill($jobLog);
            try{
                $this->jobLogDwhRepository->create($arrayJobLog);
                $shouldRemove = true;

            }catch (QueryException $exception){
                $errorCode = $exception->errorInfo[1];
                if ($errorCode===DatabaseErrorCode::DUPLICATE_ENTRY_KEY){
                     $this->logger->warning('Duplicate entry key for job_log_dwh '.$jobLog->id);
                    $shouldRemove = true;
                }
            }catch (\Exception $exception){
                $this->logger->error($exception->getMessage());
                $this->logger->error($exception->getTraceAsString());
                $shouldRemove = false;
            }

            if($shouldRemove){
                $jobLog->delete();
                $removedCount++;
            }
        }
        $this->logger->info("Removed $removedCount  job_logs which have $lifetimeInDays days lifetime and types " . $this->getJobLogTypeText($groupedJobTypes) );

        return $removedCount;


    }

    private function getJobLogTypeText($groupedJobLogTypes){
        $types = config('job_log_type_helper.types', []);
        $jobLogTypesAsString = "";

        foreach ($groupedJobLogTypes as $jobLogType) {
            $jobLogTypesAsString .= $jobLogType . "=".($types[$jobLogType] ?? '').', ';
        }

        return $jobLogTypesAsString;
    }

    private function arrayFill($jobLog)
    {
        return [
            'id' => $jobLog->id,
            'transaction_id' => $jobLog->transaction_id,
            'order_id' => $jobLog->order_id,
            'params_json' => $jobLog->params_json,
            'client_request_log' => $jobLog->client_request_log,
            'client_response' => $jobLog->client_response,
            'is_error' => $jobLog->is_error,
            'error_message' => $jobLog->error_message,
            'child_to_process_count' => $jobLog->child_to_process_count,
            'child_processed_count' => $jobLog->child_processed_count,
            'type' => $jobLog->type,
            'is_completed' => $jobLog->is_completed,
            'is_lock' => $jobLog->is_lock,
            'allowed_try_count' => $jobLog->allowed_try_count,
            'created_by_user_id' => $jobLog->created_by_user_id,
            'parent_id' => $jobLog->parent_id,
            'queue_request_log' => $jobLog->queue_request_log,
            'queue_response_log' => $jobLog->queue_response_log,
            'ip' => $jobLog->ip,
            'created_at' => $jobLog->created_at,
            'updated_at' => $jobLog->updated_at,
            'finished_at' => $jobLog->finished_at,
        ];
    }

}