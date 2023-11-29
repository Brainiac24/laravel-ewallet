<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 17:37
 */

namespace App\Repositories\Backend\Cashback;


interface CashbackRepositoryContract
{
    public function all($search);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);
}