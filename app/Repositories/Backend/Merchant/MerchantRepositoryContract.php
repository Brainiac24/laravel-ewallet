<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 13:47
 */

namespace App\Repositories\Backend\Merchant;

interface MerchantRepositoryContract
{
    public function all($search);

    public function allParent($search);

    public function allWithoutParent($search);

    public function allWithoutRelations($columns = ['*']);

    public function paginate($data = [], $perPage = 30, $columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);

    public function getAllWhereAccountBalanceGreaterThanZero();

    public function findByTransitAccountIdWithoutGlobal($id);

    public function findMerchantByIdAndLockForUpdate($id);
    
    public function GetAllMerchantByCashbackId($cashback_id);

    public function updateHighestCashbackValue($id,$value);

    public function deleteImageLogo($id);
    public function deleteImageAd($id);
    public function deleteImageDetail($id);
    public function deleteContract($id, $file);

    public function generateLogin($id);

    public function updateLastSend($date, $id);
}
