<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 13:46
 */

namespace App\Repositories\Backend\Merchant;

use App\Events\Backend\Merchant\MerchantModifiedEvent;
use App\Listeners\Backend\Merchant\MerchantModifiedListener;
use App\Models\Merchant\Filters\MerchantFilter;
use App\Models\Merchant\Merchant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MerchantEloquentRepository implements MerchantRepositoryContract
{
    /**
     * @var Merchant
     */
    private $merchant;

    /**
     * MerchantEloquentRepository constructor.
     * @param Merchant $merchant
     */
    public function __construct(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    public function all($search)
    {
        return $this->merchant->where('name', 'like', '%' . $search . '%')->orderBy('name')->get();
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->merchant
            ->select($columns)
            ->with(['merchant_cashback', 'merchant_workday', 'city', 'bank_cashback', 'merchant_commission', 'bank'])
            ->filterBy(new MerchantFilter($data))
        //->where('parent_id','!=','00000000-0000-0000-0000-000000000000')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function allWithoutRelations($columns = ['*'])
    {
        $category = $this->merchant->orderBy('created_at', 'desc')->get($columns);
        return $category;
    }

    public function findById($id)
    {
        return $this->merchant->
            with('city', 'account')->
            with('merchant_workday')->
            with('merchant_cashback')->
            with('transit_account')->
            where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        //поля который при имение их надо обновить из coordinat_point_cities поля version
        $changeFields = [
            'merchant_workday_id',
            'highest_cashback_value',
            'merchant_cashback_id',
            'merchant_cashback_start_date',
            'merchant_cashback_end_date',
            'bank_cashback_id',
            'bank_cashback_start_date',
            'bank_cashback_end_date',
        ];
        $merchant = $this->merchant->findOrFail($id);
        $data=$this->insertContractDate($data, $merchant, false);
        $merchant->setOldAttributes($merchant->getAttributes());
        $contracts = $merchant->params_json['contracts'] ?? [];
        if (isset( $data['contract_file'])){
            $contracts[$data['contract_file']] = $data['contract_file'];
        }
        $data['params_json']['contracts'] = $contracts;
        DB::transaction(function () use (&$merchant, $data) {
            $merchant->update($data);
            $merchant->categories()->sync($data['merchant_category_ids']);
        });
        foreach ($merchant->getOldAttributes() as $key => $oldAttribute) {
            if (isset($data[$key]) && $data[$key] != $oldAttribute && in_array($key, $changeFields)){
                if (substr($key, -4) == 'date' &&
                    Carbon::parse($data[$key])->format('Y-m-d H:i') == Carbon::parse($oldAttribute)->format('Y-m-d H:i')){
                    continue;
                }
                event(new MerchantModifiedEvent($merchant));
                return $merchant;
            }
        }
        return $merchant;
    }

    public function destroy($id)
    {
        $merchant = $this->merchant->findOrFail($id);
        $merchant->is_active = 0;
        $merchant->save();
        return $merchant;
    }

    public function create(array $data)
    {
        $contracts = [];
        if (isset( $data['contract_file'])){
            $contracts[$data['contract_file']] = $data['contract_file'];
        }
        $data['params_json']['contracts'] = $contracts;
        $data['login']=$this->generateMd5();
        $data=$this->insertContractDate($data, null, true);
        $merchant = new Merchant($data);
        $merchant->save();
        //dd($data['merchant_category_ids']);
        DB::transaction(function () use ($data, &$merchant) {
            $merchant->categories()->sync($data['merchant_category_ids']);
        });

        return $merchant;
    }

    public function allWithoutParent($search)
    {
        return $this->merchant
            ->where('name', 'like', '%' . $search . '%')
            ->where('parent_id', '!=', '00000000-0000-0000-0000-000000000000')
            ->orderBy('name')
            ->get();
    }

    public function allParent($search)
    {
        return $this->merchant
            ->where('name', 'like', '%' . $search . '%')
            ->where('parent_id', '=', '00000000-0000-0000-0000-000000000000')
            ->orderBy('name')
            ->get();
    }

    public function getAllWhereAccountBalanceGreaterThanZero()
    {
        return $this->merchant
        ->with('account')
           /* ->whereHas('account', function ($q) {
                $q->whereRaw(' (balance - blocked_balance) > ?', [0])->withoutGlobalScopes();
            })*/
            ->where('is_active', true)
            /*->where(function ($query) {
                $query->whereNull('last_withdraw_at')
                    ->orWhere('last_withdraw_at', '<', Carbon::now()->subMinutes(config('app_settings.merchant_last_withdraw_interval'))->format('Y-m-d H:i:s'));
            })*/
            ->withoutGlobalScopes()
            ->get();
    }

    public function findByTransitAccountIdWithoutGlobal($id)
    {
        return $this->merchant
            ->where('transit_account_id', $id)
            ->with('transit_account')
            ->withoutGlobalScopes()
            ->first();
    }

    public function findMerchantByIdAndLockForUpdate($id)
    {
        return $this->merchant->lockForUpdate()->findOrFail($id);
    }
    
    public function GetAllMerchantByCashbackId($cashback_item_id)
    {
        $merchants = $this->merchant
            ->where('merchant_cashback_id', $cashback_item_id)
            ->orWhere('bank_cashback_id', $cashback_item_id)
            ->get();
        return $merchants;
    }

    public function updateHighestCashbackValue($id, $value)
    {
        $merchant = $this->merchant->findOrFail($id);
        $old_highest_cashback_value = $merchant->highest_cashback_value;
        $merchant->highest_cashback_value = $value;
        $merchant->save();
        if ($old_highest_cashback_value != $value){
            event(new MerchantModifiedEvent($merchant));
        }
        return $merchant;
    }

    public function deleteImageLogo($id)
    {
        $merchant = $this->findById($id);
        $merchant->img_logo = null;
        $merchant->save();
        return $merchant;
    }

    public function deleteImageAd($id)
    {
        $merchant = $this->findById($id);
        $merchant->img_ad = null;
        $merchant->save();
        return $merchant;
    }

    public function deleteImageDetail($id)
    {
        $merchant = $this->findById($id);
        $merchant->img_detail = null;
        $merchant->save();
        return $merchant;
    }

    public function listByUserBranch()
    {
        return $this->merchant->with('branch')
            ->userBranch()
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->prepend("","");
    }

    public function generateLogin($id)
    {
        $merchant=$this->merchant->findOrFail($id);
        if (empty($merchant->login)){
            $merchant->setOldAttributes($merchant->getAttributes());
            $merchant->login=$this->generateMd5();
            $merchant->save();
            return $merchant;
        }
        return null;
    }

    public function deleteContract($id, $file)
    {
        $merchant=$this->merchant->findOrFail($id);
        if (isset($merchant->params_json['contracts'][$file])){
            $params_json = $merchant->params_json;
            unset($params_json['contracts'][$file]);
            $merchant->params_json = $params_json;
            $merchant->save();
        }
    }

    function generateMd5(){
        return md5(microtime());
    }

    public function updateLastSend($date, $id)
    {
        $merchant = $this->merchant->findOrFail($id);
        $params_json = $merchant->params_json;
        $params_json['report']['last_send'] = $date;
        $merchant->params_json = $params_json;
        $merchant->save();
    }

    function insertContractDate($data, $merchant=null, $isCreate=false){
        if ((isset($data['is_verified']) && $data['is_verified']) && (isset($data['is_active']) && $data['is_active'])){
            //HardCode if date >  2021-10-07
            $fixedDate = Carbon::parse('2021-10-13');
            if (($isCreate || !isset($merchant->contract_date_at)) && $merchant->created_at>$fixedDate){
                $data['contract_date_at']=Carbon::now()->format('Y-m-d H:i:s');
            }
        }
        return $data;
    }
}
