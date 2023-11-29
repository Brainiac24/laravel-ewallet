<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 18.10.2019
 * Time: 13:57
 */

namespace App\Services\Backend\Web\Merchant;

use App\Http\Requests\Backend\Web\Merchant\StoreMerchantRequest;
use App\Http\Requests\Backend\Web\Merchant\UpdateMerchantRequest;

interface MerchantServiceContract
{
    public function store(StoreMerchantRequest $request);

    public function update(UpdateMerchantRequest $request, $id);

    public function getTableList(&$filter);

    public function branchList();

    public function checkAccess();

    public function findById($id);

    public function deleteImage($name);
}