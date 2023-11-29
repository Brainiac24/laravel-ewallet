<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 04.11.2019
 * Time: 14:04
 */

namespace App\Repositories\Backend\Merchant\MerchantItem;


use App\Models\Merchant\MerchantItem\Filters\MerchantItemFilter;
use App\Models\Merchant\MerchantItem\MerchantItem;

class MerchantItemEloquentRepository implements MerchantItemRepositoryContract
{

    /**
     * @var MerchantItem
     */
    private $merchantItem;

    public function __construct(MerchantItem $merchantItem)
    {
        $this->merchantItem = $merchantItem;
    }

    public function all($search)
    {
        return $this->merchantItem->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->merchantItem
            ->select($columns)
            ->filterBy(new MerchantItemFilter($data))
            ->with('merchant')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById($id)
    {
        return $this
            ->merchantItem
            ->where('id', $id)
            ->first();
    }


    public function findByMerchantId($id)
    {
        return $this
            ->merchantItem
            ->where('merchant_id', $id)
            ->first();
    }

    public function GetAllByMerchantId($merchant_id)
    {
        return $this
            ->merchantItem
            ->where('merchant_id',$merchant_id)
            //->with('merchant')
            ->orderBy('created_at')
            ->get();
    }

    public function findByIdWithoutAccount($id)
    {
        return $this->merchantItem->where('id', $id)->first();
    }

    public function findByIdWithoutGlobal($id)
    {
        return $this
            ->merchantItem
            ->where('id', $id)
            ->with('merchant')
            ->with('account_without_global')
            ->first();
    }

    public function update(array $data, $id)
    {
        $merchantItem = $this->merchantItem->findOrFail($id);
        $merchantItem->setOldAttributes($merchantItem->getAttributes());
        $merchantItem->update($data);
        return $merchantItem;
    }

    public function destroy($id)
    {
        $merchantItem = $this->merchantItem->findOrFail($id);
        $merchantItem->is_active = 0;
        $merchantItem->save();
        return $merchantItem;
    }

    public function create(array $data)
    {
        return $this->merchantItem->create($data);
    }

    public function updateAccountNumber($id, $account_number)
    {
        $merchant = $this->merchantItem->findOrFail($id);
        $merchant['account_number'] = $account_number;
        $merchant->save();
        return $merchant;
    }

    public function findByAccountIdWithoutGlobal($account_id)
    {
        return $this
            ->merchantItem
            ->with('merchant')
            ->whereHas('account_without_global', function ($q) use ($account_id)  {
                $q->where('id', $account_id);
            })
            ->first();
    }

    public function generateHash($id)
    {
        $merchantItem=$this->merchantItem->findOrFail($id);
        if (empty($merchantItem->hash)){
            $merchantItem->setOldAttributes($merchantItem->getAttributes());
            $merchantItem->hash=md5(microtime());
            $merchantItem->save();
            return $merchantItem;
        }
        return null;
    }

    public function generateSettingsJson($id)
    {
        $merchantItem=$this->merchantItem->findOrFail($id);
        if (empty($merchantItem->hash) || empty($merchantItem->merchant->login)){
            return null;
        }
        $merchantName=trim($merchantItem->merchant->name);
        $lenMerchantName=mb_strlen($merchantName);
        if ($lenMerchantName<41){
            $addSpace='';
            $count=(41-$lenMerchantName)/2;
            for ($i=0;$i<$count;$i++){
                $addSpace.=' ';
            }
            $merchantName=$addSpace.$merchantName.$addSpace;
        }
        $merchantItemName=trim(str_replace(['Касса','касса'], '',$merchantItem->name));
        $settingsJson=config('settings_json');
        $settingsJson['key']=$merchantItem->hash;
        $settingsJson['login']=$merchantItem->merchant->login;
        $settingsJson['merchant_item_id']=$merchantItem->id;

        $settingsJson['printer']['template']['client_text'][0]=$merchantName;
        $settingsJson['printer']['template']['client_text'][2]=$merchantItem->merchant->address;
        $settingsJson['printer']['template']['client_text'][3]='Тел: '.$merchantItem->phone;
        $settingsJson['printer']['template']['client_text'][4]='Касса: '.$merchantItemName;
        $settingsJson['printer']['template']['cashier_text'][0]=$merchantName;
        $settingsJson['printer']['template']['cashier_text'][2]=$merchantItem->merchant->address;
        $settingsJson['printer']['template']['cashier_text'][3]='Тел: '.$merchantItem->phone;
        $settingsJson['printer']['template']['cashier_text'][4]='Касса: '.$merchantItemName;

        return json_encode($settingsJson,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES );
    }
}