<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 25.08.2021
 * Time: 21:40
 */

namespace App\Repositories\Backend\JobLog;


interface JobLogDwhRepositoryContract
{
    public function create(array $data);

    public function recordsBeforeDate($date, $groupedJobLogTypes);
}