<?php

namespace App\Models\Transaction;

use App\Models\Account\Account;
use App\Models\BaseModel;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantItem\MerchantItem;
use App\Models\Service\Service;
use App\Models\Transaction\TransactionHistory\TransactionHistory;
use App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail;
use App\Models\Transaction\TransactionStatus\TransactionStatus;
use App\Models\Transaction\TransactionSyncStatus\TransactionSyncStatus;
use App\Models\Transaction\TransactionType\TransactionType;
use App\Models\User\User;
use App\Repositories\Backend\Merchant\MerchantItem\MerchantItemRepositoryContract;
use App\Services\Common\Filter\Filterable;

/**
 * App\Models\Transaction\Transaction
 *
 * @property string $id
 * @property string|null $from_account_id
 * @property string|null $to_account_id
 * @property string $service_id
 * @property float $amount
 * @property float|null $commission
 * @property array|null $params_json
 * @property int $session_number
 * @property string $transaction_type_id
 * @property string|null $finished_at
 * @property string|null $next_try_at
 * @property string|null $created_by_user_id
 * @property string $transaction_status_id
 * @property string $transaction_status_detail_id
 * @property int|null $try_count
 * @property int|null $flag
 * @property string|null $comment
 * @property float|null $currency_rate_value
 * @property string $currency_iso_name
 * @property float|null $account_balance
 * @property string|null $device_platform
 * @property string|null $sms_code
 * @property \Illuminate\Support\Carbon|null $sms_code_sent_at
 * @property int|null $sms_code_sent_count
 * @property int|null $sms_confirm_try_count
 * @property \Illuminate\Support\Carbon|null $sms_confirm_try_at
 * @property int|null $add_to_favorite
 * @property int|null $is_queued
 * @property int|null $session_in
 * @property array|null $request
 * @property array|null $response
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account\Account|null $from_account
 * @property-read \App\Models\Account\Account|null $from_account_without_g_scopes
 * @property-read mixed $amount_all
 * @property-read mixed $params_json_implode
 * @property-read \App\Models\Service\Service $service
 * @property-read \App\Models\Account\Account|null $to_account
 * @property-read \App\Models\Account\Account|null $to_account_without_g_scopes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction\TransactionHistory\TransactionHistory[] $transaction_histories
 * @property-read \App\Models\Transaction\TransactionStatus\TransactionStatus $transaction_status
 * @property-read \App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail $transaction_status_detail
 * @property-read \App\Models\Transaction\TransactionType\TransactionType $transaction_type
 * @property-read \App\Models\User\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereAccountBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereAddToFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereCreatedByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereCurrencyIsoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereCurrencyRateValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereDevicePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereFromAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereIsQueued($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereNextTryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereParamsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereSessionIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereSessionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereSmsCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereSmsCodeSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereSmsCodeSentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereSmsConfirmTryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereSmsConfirmTryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereToAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereTransactionStatusDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereTransactionStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereTryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transaction extends BaseModel
{

    use Filterable;

    protected $casts = [
        'params_json' => 'array',
        'device_platform' => 'array',
        'request' => 'array',
        'response' => 'array',
        'process_payload_json' => 'array',
        'cache_json' => 'array',
        'user_service_limit_json' => 'array',
    ];

    public function getClass()
    {
        return self::class;
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'sms_code_sent_at',
        'sms_confirm_try_at',
        'confirmed_at',
    ];

    public $fillable = [
        'from_account_id',
        'to_account_id',
        'service_id',
        'amount',
        'commission',
        'converted_amount',
        'params_json',
        'transaction_type_id',
        'finished_at',
        'next_try_at',
        'created_by_user_id',
        'transaction_status_id',
        'transaction_status_detail_id',
        'transaction_sync_status',
        'try_count',
        'comment',
        'currency_rate_value',
        'currency_iso_name',
        'from_currency_iso_name',
        'to_currency_iso_name',
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
        'session_in',
        'add_to_favorite',
        'order_id',
        'request',
        'response',
        'is_queued',
        'is_cashback_process_completed'
    ];

    public function getAmountAllAttribute()
    {
        return round(((double) $this->amount) + ((double) $this->commission), 4);
    }

    public function getParamsJsonImplodeAttribute()
    {
        $str = null;
        foreach ($this->params_json as $item) {
            $str .= implode('=', $item) . ';';
        }
        return $str;
    }

    public function getToAccountTextAttribute()
    {
        $str = '';
        foreach ($this->params_json as $item) {
            if ($item['key'] == 'to_account') {
                $str = $item['value'];
            }
        }
        return $str;
    }
    public function getToMerchantTextAttribute()
    {
        $str = '';
        foreach ($this->params_json as $item) {
            if ($item['key'] == 'merchant_name') {
                $str = $item['value'];
            }
        }
        return $str;
    }

    public function getToMerchantItemNameTextAttribute()
    {
        $str = null;

        if ($this->service_id == \App\Services\Common\Helpers\Service::MERCHANT) {
            foreach ($this->params_json as $item) {
                if ($item['key'] == 'to_account') {

                    if (isset($this->merchant_item->name)) {
                        $str = $this->merchant_item->name;
                    }
                }
            }
        }

        return $str;
    }

    public function getDevicePlatformImplodeAttribute()
    {
        return count($this->device_platform) > 0 ? implode('=', $this->device_platform) . ';' : null;
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

    public function transaction_type()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function transaction_status()
    {
        return $this->belongsTo(TransactionStatus::class);
    }

    public function transaction_status_detail()
    {
        return $this->belongsTo(TransactionStatusDetail::class);
    }

    public function transaction_sync_status()
    {
        return $this->belongsTo(TransactionSyncStatus::class);
    }

    public function transaction_histories()
    {
        return $this->hasMany(TransactionHistory::class);
    }

    public function children()
    {
        return $this->hasMany(Transaction::class, 'parent_id', 'id');
    }

    public function merchant_item()
    {
        return $this->belongsTo(MerchantItem::class);
    }


    public function merchant_item_by_to_account_id()
    {
        return $this->hasMany(MerchantItem::class, "account_id", "to_account_id")->withoutGlobalScopes();
    }

    public function merchant_by_to_account_id()
    {
        return $this->hasMany(Merchant::class, "transit_account_id", "to_account_id")->withoutGlobalScopes();
    }


    public function cashback_form_merchant()
    {
        return $this->hasOne(Transaction::class, 'parent_id', 'id')
            ->where('service_id', \App\Services\Common\Helpers\Service::CASHBACK_FROM_MERCHANT);
    }

    public function getCommentForReport()
    {
        return sprintf("Перевод электронных денежных средств с кошелька %s на кошелёк %s от %s",
            $this->from_account_without_g_scopes->user_without_g_scopes->username ?? "",// номер кошелка отправителя
                $this->to_account_without_g_scopes->user_without_g_scopes->username ?? "",//номер кошелка получателя
                    $this->created_at->format('d-m-Y')//дата
            );
    }

}
