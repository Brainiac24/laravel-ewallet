<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 25.08.2021
 * Time: 21:55
 */

namespace App\Services\Backend\Web\DwgRule;


use App\Repositories\Backend\DwhRule\DwhRuleRepositoryContract;
use Illuminate\Support\Facades\Log;

class DwhRuleService implements DwhRuleServiceContract
{
    private $dwhRuleRepository;

    public function __construct(DwhRuleRepositoryContract $ruleRepositoryContract)
    {
        $this->dwhRuleRepository = $ruleRepositoryContract;
    }

    public function jobLogRulesGroupedToDwh()
    {
        $rules = $this->dwhRuleRepository->getAllByTable('job_logs');
        $groupedToDwh = [];

        foreach ($rules as $rule) {

            if($rule->to_dwh_days){
                $groupedToDwh[$rule->to_dwh_days][] = $rule->job_log_type;
            }
        }

        return $groupedToDwh;
    }

    public function jobLogRulesGroupedDeleteFromDwh()
    {
        $rules = $this->dwhRuleRepository->getAllByTable('job_logs');
        $groupedDeleteFromDwh = [];

        foreach ($rules as $rule) {
            if (isset($rule->delete_from_dwh_days)) {
                $groupedDeleteFromDwh[$rule->delete_from_dwh_days][] = $rule->job_log_type;
            }
        }

        return $groupedDeleteFromDwh;
    }

    public function userHistoryDwhRule()
    {
        // В текущей схеме для таблицы user_histories предполагается только одна запись
        return $this->dwhRuleRepository->getAllByTable('user_histories')->first();
    }

    public function transactionHistoryDwhRule()
    {
        return $this->dwhRuleRepository->getAllByTable('transaction_histories')->first();
    }
}