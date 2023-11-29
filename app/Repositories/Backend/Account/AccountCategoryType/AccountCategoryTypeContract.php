<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 16.07.2019
 * Time: 8:47
 */

namespace App\Repositories\Backend\Account\AccountCategoryType;


interface AccountCategoryTypeContract
{
    public function all($columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);
}