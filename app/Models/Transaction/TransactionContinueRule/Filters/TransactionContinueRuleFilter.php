<?php


namespace App\Models\Transaction\TransactionContinueRule\Filters;


use App\Services\Common\Filter\QueryFilter;

class TransactionContinueRuleFilter extends QueryFilter
{

    public function id($value)
    {
        if (isset($value)) {
            return $this->query->whereRaw('id like ?', ["%{$value}%"]);
        }
        return $this->query;
    }

    public function transactionStatusId($value)
    {
        if (isset($value)){
            return $this->query->where('transaction_status_id', '=', "$value");
        }
        return $this->query;
    }

    public function fromGatewayId($value)
    {
        if (isset($value)){
            return $this->query->where('from_gateway_id', '=', "$value");
        }
        return $this->query;
    }

    public function transactionSyncStatusId($value)
    {
        if (isset($value)){
            return $this->query->where('transaction_sync_status_id', '=', "$value");
        }
        return $this->query;
    }

    public function toGatewayId($value)
    {
        if (isset($value)){
            return $this->query->where('to_gateway_id', '=', "$value");
        }
        return $this->query;
    }

    public function isActive($value)
    {
        if (isset($value)){
            return $this->query->where('is_active', '=', "$value");
        }
        return $this->query;
    }

}