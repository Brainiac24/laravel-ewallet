<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 30.08.2019
 * Time: 11:04
 */

namespace App\Repositories\Backend\User\UnverifiedUser;


interface UnverifiedUserRepositoryContract
{
    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);
}