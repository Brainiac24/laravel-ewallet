<?php

namespace App\Http\Resources\Frontend\Api\Account;

use \App\Models\Account\Account;
use App\Services\Common\Helpers\Helper;
use Illuminate\Http\Resources\Json\Resource;

class AccountBalanceResource extends Resource
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
        return [
            'balance' => Helper::roundTo2dp($this->balance_all),
            'number' => $this->number,
            'currency_iso_name' => $this->currency->iso_name,
            'account_type_name' => $this->account_type->name
        ];
    }
}
