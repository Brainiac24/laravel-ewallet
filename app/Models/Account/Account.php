<?php

namespace App\Models\Account;


use App\Models\Account\AccountHistory\AccountHistory;
use App\Models\Account\AccountStatus\AccountStatus;
use App\Models\Account\AccountType\AccountType;
use App\Models\Account\Scopes\OwnUserIdScope;
use App\Models\BaseModel;
use App\Models\Currency\Currency;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Account\Account
 *
 * @property string $id
 * @property string $number
 * @property float $balance
 * @property float $blocked_balance
 * @property string $account_type_id
 * @property string $user_id
 * @property string $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account\AccountHistory\AccountHistory[] $accountHistories
 * @property-read \App\Models\Account\AccountType\AccountType $account_type
 * @property-read \App\Models\Currency\Currency $currency
 * @property-read mixed $balance_all
 * @property-read \App\Models\User\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account whereAccountTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account whereBlockedBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\Account whereUserId($value)
 * @mixin \Eloquent
 */
class Account extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'balance',
        'account_status_id',
        'params_json',
    ];

    protected $casts = [
        'balance' => 'float',
        'number' => 'string',
        'params_json' => 'array',
        'limits_json' => 'array',
    ];

    protected static function boot()
    {
        parent::boot_uuid();
        static::addGlobalScope(new OwnUserIdScope);
    }

    public function getBalanceHiddenAttribute()
    {
        $balance = $this->balance;
        if(strlen($this->balance)>3){
            $str_pos=strpos($balance,'.');
            if(strpos($balance,'.')!==false){
                $balance = sprintf("%s*%s",substr($balance,0,1),substr($balance, $str_pos,strlen($balance)-$str_pos));
            }
            else{
                $balance = sprintf("%s*%s",substr($balance,0,1),strrev(substr(strrev($this->balance),0,2)));
            }
        }

        return $balance;
    }

    public function getBalanceAllAttribute()
    {
        return round(((double)$this->balance) - ((double)$this->blocked_balance), 4);
    }

    public function account_type()
    {
        return $this->belongsTo(AccountType::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function user_without_g_scopes()
    {
        return $this->belongsTo(User::class, 'user_id')->withoutGlobalScopes()->withDefault();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class)->withDefault();
    }

    public function accountHistories()
    {
        return $this->hasMany(AccountHistory::class);
    }

    public function account_status()
    {
        return $this->belongsTo(AccountStatus::class)->withDefault();
    }
}
