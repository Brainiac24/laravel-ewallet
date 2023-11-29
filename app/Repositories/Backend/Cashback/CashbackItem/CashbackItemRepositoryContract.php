<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.12.2019
 * Time: 14:29
 */

namespace App\Repositories\Backend\Cashback\CashbackItem;


interface CashbackItemRepositoryContract
{
    public function all($columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);

    public function GetAllByCashbackId($cashback_id);

    public function GetMaxValueFromColumnMaxByCashbackId($cashback_id);

    public function GetMaxValueFromColumnValueByCashbackId($merchan_cashback_id, $bank_cashback_id);

    public function destroy($id);

    public function create(array $data);
}