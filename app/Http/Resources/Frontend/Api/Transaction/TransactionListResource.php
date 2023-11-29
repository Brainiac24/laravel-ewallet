<?php

namespace App\Http\Resources\Frontend\Api\Transaction;

use App\Http\Resources\Frontend\Api\Transaction\TransactionStatusGroup\TransactionStatusGroupResource;
use App\Http\Resources\Frontend\Api\Transaction\TransactionType\TransactionTypeResource;
use App\Services\Common\Helpers\Helper;
use App\Services\Common\Helpers\Service as SERVICES;
use App\Services\Common\Helpers\TransactionType;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class TransactionListResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this);

        $params_value = null;
        foreach ($this->service->params_json as $value) {
            foreach ($this->params_json as $value2) {
                if (isset($value['is_main'])) {
                    if ($value['is_main'] == 1 && $value['input_name'] == $value2['key']) {
                        $params_value = $value2;
                    }
                }
            }
        }

        if ($params_value == null) {
            if (isset($this->params_json[0])) {
                $params_value = $this->params_json[0];
            }
        }

        $math_prefix = '';

        //ХАРДКОД TransactionTypeResource inverse Type for ewallet users
        $tran_type['code'] = $this->transaction_type->code;
        //$tran_type['name'] = $this->transaction_type->name;

        switch ($this->transaction_type->id) {
            case TransactionType::PAYMENT:
                if ($this->service->id == SERVICES::EWALLET_ESKHATA && $this->to_account_without_g_scopes->user->id == Auth::user()->id) {
                    $math_prefix = '+';
                    $tran_type['code'] = 'FILL_EWALLET';
                } else {
                    $math_prefix = '-';
                }
                break;
            case TransactionType::FILL:
                $math_prefix = '+';
                break;
            case TransactionType::return :
                $math_prefix = '';
                break;
            default:
        }

        $msisdn = $params_value['value'];
        if ($this->service->id == SERVICES::EWALLET_ESKHATA && $this->to_account_without_g_scopes->user->id == Auth::user()->id) {
            $msisdn = $this->from_account_without_g_scopes->user->msisdn;
        }

        //ХАРДКОД $category = 'Пополнение';
        $category = '';
        if ($this->service->id == SERVICES::FILL_EWALLET_ESKHATA) {
            $category = 'Пополнение';
        }

        return [
            'date' => $this->created_at->format('d.m.Y'),
            'header' => $this->created_at->format('H:i') . ', ' . ($this->service->categories[0]->name ?? $category),
            'content' => $this->service->name . ', ' . $msisdn,
            'footer' => $math_prefix . (Helper::roundTo2dp($this->amount_all)) . ' ' . $this->currency_iso_name,
            'transaction_id' => $this->id,
            'session_number' => (string)$this->session_number,
            'service_icon' => $this->service->icon_url,
            //TODO transaction_type payment fill
            'transaction_type' => new TransactionTypeResource($tran_type),
            'transaction_status' => new TransactionStatusGroupResource($this->transaction_status->transaction_status_group),
        ];
    }
}
