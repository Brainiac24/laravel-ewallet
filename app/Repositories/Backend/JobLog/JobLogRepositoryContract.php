<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11.07.2019
 * Time: 10:51
 */

namespace App\Repositories\Backend\JobLog;


interface JobLogRepositoryContract
{
    public function all($data = [], $columns = ['*']);

    public function getAllWithCreatedBy($perPage = 30);

    public function getByIdWithCreatedBy($id);

    public function paginate($perPage = 30, $columns = ['*']);

    public function recordsBeforeDate($date, $jobLogTypes);
}