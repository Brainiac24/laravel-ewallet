<?php


namespace App\Models\Transaction\TransactionContinueRule;


use App\Models\BaseModel;
use App\Models\Gateway\Gateway;
use App\Models\Transaction\TransactionContinueRuleAccordance\TransactionContinueRuleAccordance;
use App\Models\Transaction\TransactionStatus\TransactionStatus;
use App\Models\Transaction\TransactionSyncStatus\TransactionSyncStatus;
use App\Services\Common\Filter\Filterable;

class TransactionContinueRule extends BaseModel
{
    use Filterable;

    public $table = 'transaction_continue_rules';

    protected $fillable = [
        'transaction_status_id',
        'from_gateway_id',
        'transaction_sync_status_id',
        'to_gateway_id',
        'is_active',
    ];

    public function transaction_status()
    {
        return $this->belongsTo(TransactionStatus::class,'transaction_status_id')->withDefault();
    }

    public function transaction_sync_status()
    {
        return $this->belongsTo(TransactionSyncStatus::class,'transaction_sync_status_id')->withDefault();
    }

    public function from_gateway()
    {
        return $this->belongsTo(Gateway::class,'from_gateway_id')->withDefault();
    }

    public function to_gateway()
    {
        return $this->belongsTo(Gateway::class,'to_gateway_id')->withDefault();
    }

    public function transaction_continue_rule_accordance()
    {
        return $this->hasMany(TransactionContinueRuleAccordance::class, 'transaction_continue_rule_id');
    }

    public function getNameAttribute()
    {
        return sprintf("%s: %s, %s: %s, %s: %s, %s: %s",
            trans('transactionContinueRule.backend.transaction_status_id'), $this->transaction_status->name,
            trans('transactionContinueRule.backend.transaction_sync_status_id'), $this->transaction_sync_status->name,
            trans('transactionContinueRule.backend.from_gateway_id'), $this->from_gateway->name,
            trans('transactionContinueRule.backend.to_gateway_id'), $this->to_gateway->name);
    }

}