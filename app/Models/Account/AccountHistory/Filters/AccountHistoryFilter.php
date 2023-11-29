<?php


namespace App\Models\Account\AccountHistory\Filters;


use App\Services\Common\Filter\QueryFilter;

class AccountHistoryFilter extends QueryFilter
{

    public function transactionStatusId($value)
    {

        if (empty($value)) {
            return $this->query;
        }else {
            return $this->query->where('transaction_status_id',$value);
        }
    }

    public function transactionTypeId($value)
    {
        if (empty($value)) {
            return $this->query;
        }else {
            return $this->query->where('transaction_type_id',$value);
        }
    }

    public function accountTypeId($value)
    {
        if (empty($value)) {
            return $this->query;
        }else {
            return $this->query->where('account_type_id',$value);
        }
    }

    public function toDate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '<=', "{$value} 23:59:59");
        }
    }

    public function fromDate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '>=', "{$value} 00:00:00");
        }
    }
}