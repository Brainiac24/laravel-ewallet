<?php

namespace App\Models\Account\AccountHistory;

use App\Models\Account\Account;
use App\Models\Account\AccountType\AccountType;
use App\Models\BaseModel;
use App\Models\Currency\Currency;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\TransactionStatus\TransactionStatus;
use App\Models\Transaction\TransactionType\TransactionType;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;

/**
 * App\Models\Account\AccountHistory\AccountHistory
 *
 * @property string $id
 * @property string $account_id
 * @property int $number
 * @property float $amount
 * @property float|null $commission
 * @property float $balance
 * @property float $blocked_balance
 * @property string $account_type_id
 * @property string $currency_id
 * @property float $currency_rate_value
 * @property string $transaction_type_id
 * @property string|null $transaction_id
 * @property string $created_by_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account\Account $account_histories
 * @property-read \App\Models\Account\AccountType\AccountType $account_type
 * @property-read \App\Models\Currency\Currency $currency
 * @property-read \App\Models\Transaction\TransactionType\TransactionType $transaction_type
 * @property-read \App\Models\User\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereAccountTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereBlockedBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereCreatedByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereCurrencyRateValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountHistory\AccountHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountHistory extends BaseModel
{
    use Filterable;

    public function account_histories()
    {
        return $this->belongsTo(Account::class)->withDefault();
    }
    public function account_type()
    {
        return $this->belongsTo(AccountType::class)->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by_user_id')->withDefault();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class)->withDefault();
    }
    public function transaction_type()
    {
        return $this->belongsTo(TransactionType::class,'transaction_type_id')->withDefault();
    }
    public function transaction_status()
    {
        return $this->belongsTo(TransactionStatus::class,'transaction_status_id')->withDefault();
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'transaction_id')->withDefault();
    }
}
