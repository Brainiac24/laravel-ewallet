<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 19.03.2020
 * Time: 10:00
 */

namespace App\Http\Resources\Backend\Web\Transaction;


use App\Services\Common\Helpers\Service;
use App\Services\Common\Helpers\TransactionStatus;
use Illuminate\Http\Resources\Json\Resource;

class TransactionListResource extends Resource
{
    public function toArray($request)
    {
        $from_account = ($this->from_account_without_g_scopes != null && $this->from_account_without_g_scopes->account_type != null && $this->from_account_without_g_scopes->account_type->account_category_type != null) ?
            ($this->from_account_without_g_scopes->account_type->account_category_type->id == \App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
                $this->from_account_without_g_scopes->user->msisdn :
                $this->from_account_without_g_scopes->number) : $this->service->name;

        $to_account =
            ($this->to_account_without_g_scopes != null &&
                $this->to_account_without_g_scopes->account_type != null &&
                $this->to_account_without_g_scopes->account_type->account_category_type != null) ?
                ($this->to_account_without_g_scopes->account_type->account_category_type->id == \App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
                    $this->to_account_without_g_scopes->user->msisdn :
                    $this->to_account_without_g_scopes->number) : $this->service->name;

        $params_json_to_account = !empty($this->to_account_without_g_scopes) ? ($this->to_account_without_g_scopes->account_type->account_category_type->id == \App\Services\Common\Helpers\AccountCategoryTypes::VIRTUAL_ID ?
            $this->to_merchant_text :
            (empty($this->to_account_text) ? ($this->to_account_without_g_scopes->account_type->account_category_type->id == \App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
                $this->to_account_without_g_scopes->user->msisdn :
                $this->to_account_without_g_scopes->number) : $this->to_account_text)) : $this->to_account_text;

        $from_gateway = $this->from_account_without_g_scopes->account_type->gateway->name ?? $this->service->gateway->name;
        $to_gateway = ($this->to_account_without_g_scopes != null &&
            $this->to_account_without_g_scopes->account_type != null &&
            $this->to_account_without_g_scopes->account_type->gateway != null) ?
            $this->to_account_without_g_scopes->account_type->gateway->name : $this->service->gateway->name;

        $created_by_user = ($this->user->msisdn ?? '') . '/' . ($this->user->full_name ?? '');

        $data = [
            'recid' => $this->id,
            'from_account_id' => $from_account,
            'to_account_id' => $to_account,
            'transaction_status_id' => $this->transaction_status->name,
            'transaction_sync_status_id' => $this->transaction_sync_status->name ?? "",
            'created_at' => empty($this->created_at) ? null : \Carbon\Carbon::parse($this->created_at)->format("d.m.Y H:i:s"),
            'sms_confirm_try_at' => empty($this->confirmed_at ?? $this->sms_confirm_try_at) ? null : \Carbon\Carbon::parse($this->confirmed_at ?? $this->sms_confirm_try_at)->format("d.m.Y H:i:s"),
            'finished_at' => empty($this->finished_at) ? null : \Carbon\Carbon::parse($this->finished_at)->format("d.m.Y H:i:s"),
            'params_json_to_account' => $params_json_to_account,
            'params_json_to_merchant_item' => $this->to_merchant_item_name_text,//todo get merchant_item from relation merchant_item_id
            'service_name' => $this->service->name,
            'amount' => number_format($this->amount, 2, '.', ''),
            'from_currency_iso_name' => $this->from_currency_iso_name,
            'converted_amount' => number_format($this->converted_amount, 2, '.', ''),
            'to_currency_iso_name' => $this->to_currency_iso_name,
            'process_payload_json' => json_encode($this->process_payload_json),
            'from_gateway' => $from_gateway,
            'to_gateway' => $to_gateway,
            'commission' => number_format($this->commission, 2, '.', ''),
            'session_number' => $this->session_number,
            'created_by_user_id' => $created_by_user,
            'try_count' => $this->try_count,
            'flag' => $this->flag,
            'comment' => $this->comment,
            'currency_rate_value' => number_format($this->currency_rate_value, 4, '.', ''),
            'currency_iso_name' => $this->currency_iso_name,
            'account_balance' => number_format($this->account_balance, 2, '.', ''),
            'sms_code_sent_at' => $this->sms_code_sent_at,
            'add_to_favorite' => trans('InterfaceTranses.add_to_favorite.' . $this->add_to_favorite),
            'is_queued' => trans('InterfaceTranses.is_queied.' . $this->is_queued),
            'is_otp' => trans('InterfaceTranses.is_otp.' . $this->is_otp),
            'session_in' => $this->session_in,
            'device_platform' => json_encode($this->device_platform),
            'transaction_status_detail_id' => $this->transaction_status_detail->name,
            'order_id' => $this->order_id,
            'params_json' => $this->params_json_implode,
        ];


//        if ($this->service_id == Service::MERCHANT) {
//
//            $transactions = $transactionRepository->getByParentId($this->id);
//
//            if(!$transactions->isEmpty()){
//                $data['w2ui']['children'] = self::collection($transactions);
//            }
//        }
        if (isset($this->transaction_status->color)) {
            if (Service::MERCHANT == $this->service_id && $this->transaction_status_id == TransactionStatus::COMPLETED && $this->is_cashback_process_completed != 2) {
                    $color = '#bee5eb';

                $data['w2ui']['style'] = "background-color:{$color }";
            } else {
                $data['w2ui']['style'] = "background-color:{$this->transaction_status->color}";
            }
        }


        return $data;
    }
}