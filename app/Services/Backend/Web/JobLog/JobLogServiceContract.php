<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 20.08.2021
 * Time: 11:33
 */

namespace App\Services\Backend\Web\JobLog;


interface JobLogServiceContract
{
    public function copyToDwhAndRemoveOutdated($lifetimeInDays, $groupedRule);
}