<?php

namespace App\Http\Resources\Frontend\Api\Transaction\TransactionReceipt;

use App\Services\Common\Helpers\Service;
use Illuminate\Http\Resources\Json\Resource;

class TransactionReceiptResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this['service']['id']==Service::EWALLET_ESKHATA) {$type = 'Перевод';}else{$type= $this['transaction_type']['name'];}
       $result = [
           [trans('transactionRecieptText.arrayString.session_number')['ru'],$this['session_number']],
           [trans('transactionRecieptText.arrayString.amount')['ru'],round($this['amount'],2)],
           [trans('transactionRecieptText.arrayString.commission')['ru'],round($this['commission'],2)],
           [trans('transactionRecieptText.arrayString.currency_iso_name')['ru'],$this['currency_iso_name']],
           [trans('transactionRecieptText.arrayString.service_name')['ru'],$this['service']['name']],
           [trans('transactionRecieptText.arrayString.transaction_type')['ru'],$type],
           [trans('transactionRecieptText.arrayString.msisdn')['ru'],$this['user']['msisdn']],
           [trans('transactionRecieptText.arrayString.paysystem')['ru'],'Эсхата Онлайн'],
           [trans('transactionRecieptText.arrayString.FIO')['ru'],$this['user']['first_name']." ". $this['user']['middle_name'] ." ".$this['user']['last_name']],
           [trans('transactionRecieptText.arrayString.created_at')['ru'],(string)$this['created_at'] ],

       ];
        foreach ($this['params_json'] as $item ){
            foreach ($this['service']['params_json'] as $itemService ){
                if($itemService['input_name'] == $item['key']){
                    $result[]=[$itemService['input_placeholder'],$item['value']] ;
                }

            }

        }

        return $result;
    }
}
