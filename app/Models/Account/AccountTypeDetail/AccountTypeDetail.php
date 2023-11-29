<?php

namespace App\Models\Account\AccountTypeDetail;


use App\Models\BaseModel;
use App\Models\Account\AccountType\AccountType;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Account\AccountTypeDetail\AccountTypeDetail
 *
 * @property-read \App\Models\Account\AccountType\AccountType $accountType
 * @mixin \Eloquent
 */
class AccountTypeDetail extends BaseModel
{
    protected $fillable = [
        'name',
        'code',
        'account_type_id',
    ];

    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }


}
