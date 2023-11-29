<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 27.08.2021
 * Time: 14:08
 */

namespace App\Services\Backend\Web\JobLog;


use App\Repositories\Backend\JobLog\JobLogDwhRepositoryContract;
use App\Services\Backend\Web\DwgRule\DwhRuleServiceContract;
use App\Services\Common\Helpers\Logger\DwhRulesLogger;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class JobLogDwhService implements JobLogDwhServiceContract
{
    public $dwhRulesService;

    public $jobLogDwhRepository;

    private $logger;

    public function __construct(DwhRuleServiceContract $serviceContract, JobLogDwhRepositoryContract $dwhRepositoryContract)
    {
        $this->dwhRulesService = $serviceContract;
        $this->jobLogDwhRepository = $dwhRepositoryContract;
        $this->logger = new DwhRulesLogger();
    }

    public function findAndRemoveOutdatedDwh()
    {
        $jobLogRules = $this->dwhRulesService->jobLogRulesGroupedDeleteFromDwh();
        $removedCount = 0;
        foreach ($jobLogRules as $lifetimeInDays => $groupedJobLogTypes) {
            $date = Carbon::now()->subDays($lifetimeInDays)->format('Y-m-d 00:00:00');
            $jobLogDwhRecords = $this->jobLogDwhRepository->recordsBeforeDate($date, $groupedJobLogTypes);

            $removedCount += $this->removeOutdatedRecords($jobLogDwhRecords);
        }
        $this->logger->info("Removed $removedCount  job_log_dwh which have $lifetimeInDays lifetime");

        return $removedCount;
    }

    private function removeOutdatedRecords($jobLogDwhRecords)
    {
        $removedCount = 0;

        foreach ($jobLogDwhRecords as $jobLogDwhRecord) {
            $jobLogDwhRecord->delete();
            $removedCount++;
        }

        return $removedCount;
    }
}