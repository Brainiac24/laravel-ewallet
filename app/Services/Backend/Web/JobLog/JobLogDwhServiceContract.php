<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 27.08.2021
 * Time: 14:07
 */

namespace App\Services\Backend\Web\JobLog;


interface JobLogDwhServiceContract
{
    public function findAndRemoveOutdatedDwh();
}