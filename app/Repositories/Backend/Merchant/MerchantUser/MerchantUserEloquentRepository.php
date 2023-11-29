<?php


namespace App\Repositories\Backend\Merchant\MerchantUser;


use App\Models\Merchant\MerchantUser\Filters\MerchantUserFilter;
use App\Models\Merchant\MerchantUser\MerchantUser;

class MerchantUserEloquentRepository implements MerchantUserRepositoryContract
{
    private $merchantUser;

    public function __construct(MerchantUser $merchantUser)
    {
        $this->merchantUser=$merchantUser;
    }
    public function all()
    {
        $this->merchantUser
            ->with(['merchant', 'merchant.city', 'account', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->merchantUser
            ->select($columns)
            ->with(['merchant', 'merchant.city', 'account', 'user'])
            ->filterBy(new MerchantUserFilter($data))
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById($id)
    {
        return $this
            ->merchantUser
            ->findOrFail($id);
 //            ->where('id', $id)
//            ->with(['merchant', 'merchant.city', 'account', 'user'])
//            ->first();
    }

    public function update(array $data, $id)
    {
        $array=[
            'is_active'=>$data['is_active'],
            'is_approved'=>$data['is_approved'],
        ];
        $merchantUser = $this->merchantUser->findOrFail($id);
        $merchantUser->setOldAttributes($merchantUser->getAttributes());
        $merchantUser->update($array);
        return $merchantUser;
    }

    public function destroy($id)
    {
        $merchantUser = $this->merchantUser->findOrFail($id);
        $merchantUser->is_active = 0;
        $merchantUser->save();
        return $merchantUser;
    }
}