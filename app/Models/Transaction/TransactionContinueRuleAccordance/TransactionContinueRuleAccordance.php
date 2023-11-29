<?php


namespace App\Models\Transaction\TransactionContinueRuleAccordance;


use App\Models\BaseModel;
use App\Models\Transaction\TransactionContinueRule\TransactionContinueRule;
use App\Models\Transaction\TransactionStatus\TransactionStatus;
use App\Models\Transaction\TransactionSyncStatus\TransactionSyncStatus;
use App\Services\Common\Filter\Filterable;

class TransactionContinueRuleAccordance extends BaseModel
{
    use Filterable;
    public $table = 'transaction_continue_rule_accordance';

    protected $fillable = [
        'transaction_continue_rule_id',
        'transaction_status_id',
        'transaction_sync_status_id',
        'message',
        'allowed_users',
        'is_active',
    ];

    protected $casts = [
        'allowed_users' => 'array'
    ];

    public function transaction_status()
    {
        return $this->belongsTo(TransactionStatus::class,'transaction_status_id')->withDefault();
    }

    public function transaction_sync_status()
    {
        return $this->belongsTo(TransactionSyncStatus::class,'transaction_sync_status_id')->withDefault();
    }

    public function transaction_continue_rule()
    {
        return $this->belongsTo(TransactionContinueRule::class,'transaction_continue_rule_id')->withDefault();
    }

}