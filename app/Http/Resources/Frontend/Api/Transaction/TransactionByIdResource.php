<?php

namespace App\Http\Resources\Frontend\Api\Transaction\TransactionReceipt;

use App\Http\Resources\Frontend\Api\Transaction\TransactionStatusGroup\TransactionStatusGroupResource;
use App\Http\Resources\Frontend\Api\Transaction\TransactionType\TransactionTypeResource;
use App\Services\Common\Helpers\Helper;
use App\Services\Common\Helpers\Service as SERVICES;
use App\Services\Common\Helpers\TransactionType;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class TransactionByIdResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//to_account_without_g_scopes

        $msisdn = null;
        $transaction_params = [];

        foreach ($this->service->params_json as $value) {

            foreach ($this->params_json as $value2) {
                if ($value['input_name'] == 'phone_number' || $value['input_name'] == 'comment' || $value['input_name'] == 'to_account') {
                    if ($value['input_name'] == $value2['key'] || ($value['input_name'] == 'to_account' && ($value2['key'] == 'phone_number' || $value2['key'] == 'number' || $value2['key'] == 'login'))) {
                        $value2['name'] = $value['input_placeholder'];
                        $value2['icon_url'] = $value['icon_url'];
                        if ($value['input_name'] == 'phone_number' || $value['input_name'] == 'to_account') {
                            //ХАРДКОД inverse transaction phone_number
                            if ($this->service->id == SERVICES::EWALLET_ESKHATA && $this->to_account_without_g_scopes->user->id == Auth::user()->id) {
                                $value2['name'] = 'Номер отправителя';
                                $value2['value'] = (string)$this->from_account_without_g_scopes->user->msisdn;
                            }
                        }
                        $transaction_params[] = $value2;
                    }
                    
                }
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

        //ХАРДКОД - иконка и категория
        $category = '';
        $icon = 'fill.png';
        if ($this->service->id == SERVICES::FILL_EWALLET_ESKHATA) {
            $category = 'Пополнение';
        }

        return [
            'date' => $this->created_at->format('d.m.Y, H:m'),
            //ХАРДКОД - иконка и категория
            'category_name' => $this->service->categories[0]->name ?? $category,
            'category_icon' => $this->service->categories[0]->icon_url ?? $icon,
            'service_name' => $this->service->name,
            'service_id' => $this->service->id,
            'service_icon' => $this->service->categories[0]->icon_url ?? $icon, //$this->service->icon_url,
            'amount_all' => Helper::roundTo2dp($math_prefix . $this->amount_all),
            'amount' => Helper::roundTo2dp($math_prefix . $this->amount),
            'commission' => Helper::roundTo2dp($this->commission),
            'currency' => $this->currency_iso_name,
            //'amount_all' => $this->amount_all,
            'params' => $transaction_params,
            'transaction_type' => new TransactionTypeResource($tran_type),
            //'comment' => $this->comment,
            //'currency_rate_value' => $this->currency_rate_value,
            //'currency_iso_name' => $this->currency_iso_name,
            //'account_number' => $this->from_account_id,
            'session_number' => $this->session_number,
            'transaction_status' => new TransactionStatusGroupResource($this->transaction_status->transaction_status_group),
            //'transaction_status_detail' => new TransactionStatusDetailResource($this->transaction_status_detail),
        ];
    }
}
