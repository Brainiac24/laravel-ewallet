<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 13:22
 */

namespace App\Models\Merchant;


use App\Models\Account\Account;
use App\Models\Bank\Bank;
use App\Models\BaseModel;
use App\Models\Branch\Branch;
use App\Models\Cashback\Cashback;
use App\Models\City\City;
use App\Models\Merchant\MerchantCommission\MerchantCommission;
use App\Models\Merchant\MerchantItem\MerchantItem;
use App\Models\Merchant\MerchantWorkdays\MerchantWorkdays;
use App\Models\Merchant\MerchantCategory\MerchantCategory;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;

class Merchant extends BaseModel
{
    use Filterable;

    protected $fillable = [
        //'id',
        'name',
        'organization',
        'parent_id',
        // Отключён по причини избежание лишних проблем, например при изменении account_number
        // также надо будет учитывать изменении account_number в таблице merchant_items
        //'account_number',
//        'correspondent_account',
//        'bic',
        'phone',
        'address',
        'email',
        'account_number',
        'transit_account_id',
        'account_id',
        'inn',
        'img_logo',
        'img_ad',
        'img_detail',
        'desc',
        'city_id',
        'latitude',
        'longtitude',
        'position',
        'merchant_workday_id',
        'user_count',
        'highest_cashback_value',
        'merchant_cashback_id',
        'bank_cashback_id',
        'bank_id',
        'branch_id',
        'merchant_commission_id',
        'is_active',
        'is_qr_integrated',
        'last_withdraw_at',
        'created_at',
        'updated_at',
        'created_by_user_id',
        'updated_by_user_id',
        'webhook_url',
        'is_verified',
        'bank_cashback_start_date',
        'bank_cashback_end_date',
        'merchant_cashback_start_date',
        'merchant_cashback_end_date',
        'login',
        'generate_report',
        'params_json',
        'contract_date_at'
    ];

    protected $casts = [
        'params_json' => 'array',
        'contract_date_at'
    ];

    public function categories()
    {
        return $this->belongsToMany(MerchantCategory::class,'merchant_category_merchant')->withPivot('merchant_category_id','merchant_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function merchant_workday()
    {
        return $this->belongsTo(MerchantWorkdays::class,'merchant_workday_id');
    }

    public function merchant_cashback()
    {
        return $this->belongsTo(Cashback::class,'merchant_cashback_id');
    }

    public function bank_cashback()
    {
        return $this->belongsTo(Cashback::class,'bank_cashback_id');
    }

    public function merchant_commission()
    {
        return $this->belongsTo(MerchantCommission::class,'merchant_commission_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class,'account_id')->withoutGlobalScopes();
    }

    public function transit_account()
    {
        return $this->belongsTo(Account::class,'transit_account_id')->withoutGlobalScopes();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function created_user()
    {
        return $this->belongsTo(User::class,'created_by_user_id');
    }

    public function updated_user()
    {
        return $this->belongsTo(User::class,'updated_by_user_id');
    }

    public function merchant_items()
    {
        return $this->hasMany(MerchantItem::class,'merchant_id');
    }

    //scopes
    public function scopeUserBranch($q)
    {
        if(\Auth::user()->ability("sadmin", "merchant-can-all-branch"))
        {
            return $q;
        }elseif(\Auth::user()->can("merchant-can-by-user-branch")) {
            return $q->whereIn("branch_id", \Auth::user()->branches()->pluck("id")->toArray());
        }else{
            return $q->whereRaw("0=1");
        }
    }

    public function getMerchantItemsNameAttribute()
    {
        $merchantItemsId = $this->params_json['report']['merchant_items'] ?? [];
        $merchantItemsName = '';
        $merchantItems = MerchantItem::whereIn('id', $merchantItemsId)->get();
        $merchantItems->each(function ($item) use (&$merchantItemsName) {
            $merchantItemsName .= $item->name . ', ';
        });
        return $merchantItemsName;
    }

    public function getDocumentAttribute()
    {
        if (isset($this->params_json['contracts']) && count($this->params_json['contracts'])>0){
            return 1;
        }
        return 0;
    }

}