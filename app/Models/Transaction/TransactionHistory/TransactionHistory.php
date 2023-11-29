<?php

namespace App\Models\Transaction\TransactionHistory;

use App\Models\Account\Account;
use App\Models\BaseModel;
use App\Models\Service\Service;
use App\Models\Transaction\TransactionStatus\TransactionStatus;
use App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail;
use App\Models\Transaction\TransactionType\TransactionType;
use App\Models\User\User;
use Carbon\Carbon;


/**
 * App\Models\Transaction\TransactionHistory\TransactionHistory
 *
 * @property string $id
 * @property string $transaction_id
 * @property string $from_account_id
 * @property string $to_account_id
 * @property string $service_id
 * @property float $amount
 * @property float $amount_all
 * @property string|null $params_json
 * @property string|null $session_number
 * @property string $transaction_type_id
 * @property string $finished_at
 * @property string $next_try_at
 * @property string $created_by_user_id
 * @property string $transaction_status_id
 * @property string $transaction_status_detail_id
 * @property int $try_count
 * @property int|null $flag
 * @property string|null $comment
 * @property string $parent_id
 * @property float $currency_rate_value
 * @property string $currency_iso_name
 * @property float $account_balance
 * @property string|null $request
 * @property string|null $response
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereAccountBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereAmountAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereCreatedByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereCurrencyIsoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereCurrencyRatesValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereFromAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereNextTryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereParamsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereSessionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereToAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereTransactionStatusDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereTransactionStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereTryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User\User $CreatedUser
 * @property-read \App\Models\Transaction\TransactionStatus\TransactionStatus $TransactionStatus
 * @property-read \App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail $TransactionStatusDetail
 * @property-read \App\Models\Transaction\TransactionType\TransactionType $TransactionType
 * @property float|null $commission
 * @property string|null $device_platform
 * @property string|null $sms_code
 * @property \Illuminate\Support\Carbon|null $sms_code_sent_at
 * @property int|null $sms_code_sent_count
 * @property int|null $sms_confirm_try_count
 * @property \Illuminate\Support\Carbon|null $sms_confirm_try_at
 * @property int|null $add_to_favorite
 * @property int|null $is_queued
 * @property int|null $session_in
 * @property-read \App\Models\Account\Account|null $from_account
 * @property-read \App\Models\Service\Service $service
 * @property-read \App\Models\Account\Account|null $to_account
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereAddToFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereCurrencyRateValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereDevicePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereIsQueued($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereSessionIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereSmsCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereSmsCodeSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereSmsCodeSentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereSmsConfirmTryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\TransactionHistory\TransactionHistory whereSmsConfirmTryCount($value)
 */
class TransactionHistory extends BaseModel
{


    protected $casts = [
        'params_json' => 'array',
        'request' => 'array',
        'response' => 'array',
    ];

    protected $dates = [
        'sms_code_sent_at',
        'sms_confirm_try_at',
    ];

    protected $fillable = [
        'parent_id',
        'transaction_id',
        'from_account_id',
        'to_account_id',
        'service_id',
        'amount',
        'from_currency_iso_name',
        'commission',
        'converted_amount',
        'to_currency_iso_name',
        'currency_rate_value',
        'params_json',
        'session_number',
        'transaction_type_id',
        'finished_at',
        'next_try_at',
        'created_by_user_id',
        'transaction_status_id',
        'transaction_status_detail_id',
        'order_id',
        'merchant_item_id',
        'try_count',
        'flag',
        'comment',
        'currency_iso_name',
        'account_balance',
        'device_platform',
        'cache_json',
        'is_otp',
        'confirmed_at',
        'sms_code',
        'sms_code_sent_at',
        'sms_code_sent_count',
        'sms_confirm_try_count',
        'sms_confirm_try_at',
        'add_to_favorite',
        'is_queued',
        'is_cashback_process_completed',
        'process_payload_json',
        'user_service_limit_json',
        'session_in',
        'request',
        'response',
        'transaction_sync_status_id',
    ];

    public function getParamsJsonImplodeAttribute()
    {
        $str=null;
        foreach ($this->params_json as $item){
            $str.=implode('=', $item).';';
        }
        return $str;
    }

    public function TransactionStatusDetail()
    {
        return $this->belongsTo(TransactionStatusDetail::class);
    }

    public function TransactionStatus()
    {
        return $this->belongsTo(TransactionStatus::class);
    }

    public function TransactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function CreatedUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function from_account()
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function from_account_without_g_scopes()
    {
        return $this->belongsTo(Account::class, 'from_account_id')->withoutGlobalScopes();
    }

    public function to_account()
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }

    public function to_account_without_g_scopes()
    {
        return $this->belongsTo(Account::class, 'to_account_id')->withoutGlobalScopes();
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function Users()
    {
        return $this->belongsTo(User::class,'created_by_user_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value);
    }


    public function getCreatedAtAsStringAttribute()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAtAsStringAttribute()
    {
        return $this->attributes['updated_at'];;
    }


}
