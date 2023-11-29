<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.08.2019
 * Time: 9:22
 */

namespace App\Repositories\Backend\Purpose;


interface PurposeRepositoryContract
{
    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);
}