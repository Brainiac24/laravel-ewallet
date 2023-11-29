<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 04.11.2019
 * Time: 14:01
 */

namespace App\Models\Merchant\MerchantItem;


use App\Models\Account\Account;
use App\Models\BaseModel;
use App\Models\Merchant\Merchant;
use App\Models\Transaction\Transaction;
use App\Services\Common\Filter\Filterable;

class MerchantItem extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'id',
        'name',
        'account_number',
        'merchant_id',
        'account_id',
        'phone',
        'address',
        'email',
        'is_active',
        'created_at',
        'updated_at',
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function account_without_global()
    {
        return $this->belongsTo(Account::class, 'account_id')->withoutGlobalScopes();
    }

    public function transaction_qr()
    {
        return $this->hasMany(Transaction::class,"to_account_id", "account_id")
            ->where("service_id",\App\Services\Common\Helpers\Service::MERCHANT);
    }
}