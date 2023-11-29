<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 15:03
 */

namespace App\Repositories\Backend\Merchant\MerchantWorkdays;


interface MerchantWorkdaysRepositoryContract
{
    public function all($search);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);
}