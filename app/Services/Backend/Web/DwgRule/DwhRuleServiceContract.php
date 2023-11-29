<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 25.08.2021
 * Time: 21:54
 */

namespace App\Services\Backend\Web\DwgRule;


interface DwhRuleServiceContract
{

    public function jobLogRulesGroupedToDwh();
    public function jobLogRulesGroupedDeleteFromDwh();

    public function userHistoryDwhRule();

    public function transactionHistoryDwhRule();

}