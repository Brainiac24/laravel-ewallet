<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Frontend\Buglog;


interface BuglogRepositoryContract
{
    public function log($data=[]);

}