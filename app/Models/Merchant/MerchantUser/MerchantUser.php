<?php


namespace App\Models\Merchant\MerchantUser;


use App\Models\Account\Account;
use App\Models\BaseModel;
use App\Models\Merchant\Merchant;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;

class MerchantUser extends BaseModel
{
    use Filterable;
    protected $fillable=[
        'is_active',
        'is_approved',
    ];

    protected $table='merchant_user';

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'user_business_account_id')->withoutGlobalScopes();
    }

}