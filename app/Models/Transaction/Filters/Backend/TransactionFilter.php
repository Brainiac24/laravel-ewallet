<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 03.10.2018
 * Time: 9:48
 */

namespace App\Models\Transaction\Filters\Backend;


use App\Models\User\User;
use App\Services\Common\Filter\QueryFilter;

class TransactionFilter extends QueryFilter
{
    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->where('id', $value);
        }
    }

    public function createdByUserId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            $user = User::where('msisdn','LIKE',"%{$value}%")->first();
            $id = $user->id ?? "00000000-0000-0000-0000-000000000000";
            return $this->query->where('created_by_user_id',$id);
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

    public function serviceId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('service_id', '=', "$value");
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

    public function sessionIn($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('session_number', 'like', "%$value%");
        }
    }

    public function toAccountMsisdn($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('params_json', 'like', "%$value%");
        }
    }

    public function fromAccountId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('from_account_id', function($q) use ($value){
                $q->select('id')->from('accounts')->where('number', $value)->limit(1);
            });
        }
    }

    public function transactionStatusId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('transaction_status_id', '=', "$value");
        }
    }

    public function transactionStatusGroupId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->whereIn('transaction_status_id', function ($q) use ($value) {
                $q->select('id')->from('transaction_status')->where('transaction_status_group_id', $value);
            });
        }
    }

    public function transactionSyncStatusId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('transaction_sync_status_id', $value);
        }
    }

    public function orderId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('order_id', '=', "$value");
        }
    }

    public function fromDateFinish($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('finished_at', '>=', "{$value} 00:00:00");
        }
    }

    public function toDateFinish($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('finished_at', '<=', "{$value} 23:59:59");
        }
    }

    public function merchantBranchesId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->whereHas("merchant_item.merchant", function ($query)use($value){
                $query->whereIn('branch_id', $value);
            });
        }
    }

    public function merchantId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->whereIn('merchant_item_id', function ($q) use ($value) {
                $q->select('id')->from('merchant_items')->where("merchant_id", $value);
            });
        }
    }

    public function merchantItemId($value)
    {
        if (empty($value)) {
            return $this->query;
        } else {
            return $this->query->where('merchant_item_id', $value);
        }
    }

    public function fromGatewayId($value)
    {
        if(empty($value)){
            return $this->query;
        }else{
            return $this->query->whereIn('from_account_id', function ($q) use ($value){
               $q->select('accounts.id')->from('accounts')->leftJoin('account_types', 'accounts.account_type_id', '=', 'account_types.id')
                   ->where('account_types.gateway_id',$value);
            });
        }
    }

    public function toGatewayId($value)
    {
        if(empty($value)){
            return $this->query;
        }else{
            return $this->query->whereIn('to_account_id', function ($q) use ($value){
                $q->select('accounts.id')->from('accounts')->leftJoin('account_types', 'accounts.account_type_id', '=', 'account_types.id')
                    ->where('account_types.gateway_id',$value);
            });
        }
    }

    public function fromGatewayOrToGateway($value)
    {
        if(is_array($value) && array_key_exists('from_gateway_id', $value) && array_key_exists('to_gateway_id', $value)){
            return $this->query->whereRaw('(from_account_id IN 
            (SELECT accounts.id FROM accounts LEFT JOIN account_types ON accounts.account_type_id = account_types.id WHERE account_types.gateway_id = "'.$value['from_gateway_id'].'") 
             OR to_account_id IN 
             (SELECT accounts.id FROM accounts LEFT JOIN account_types ON accounts.account_type_id = account_types.id WHERE account_types.gateway_id = "'.$value['to_gateway_id'].'"))');

        }else{
            return $this->query;
        }
    }
}