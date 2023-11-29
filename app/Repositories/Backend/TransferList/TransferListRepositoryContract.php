<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 15:39
 */

namespace App\Repositories\Backend\TransferList;


interface  TransferListRepositoryContract
{
    public function all($columns = ['*']);
    public function findById($id, $columns = ['*']);

    public function create(array $data);

    public function update(array $data, $id);

    public function destroy($id);
}