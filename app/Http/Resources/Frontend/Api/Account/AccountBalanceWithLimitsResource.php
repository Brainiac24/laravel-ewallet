<?php

namespace App\Http\Resources\Frontend\Api\Account;

use App\Services\Common\Helpers\Helper;
use Illuminate\Http\Resources\Json\Resource;

class AccountBalanceWithLimitsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'balance' => Helper::roundTo2dp($this->balance_all),
            'number' => $this->number,
            'currency_iso_name' => $this->currency->iso_name,
            'account_type_name' => $this->account_type->name,
            'current_limits' => [
                "day_limit" => Helper::roundTo2dp($this->user->attestation->params_json['day']['limit'] - $this->user->limits_json['day']['limit']),
                "week_limit" => Helper::roundTo2dp($this->user->attestation->params_json['week']['limit'] - $this->user->limits_json['week']['limit']),
                "month_limit" => Helper::roundTo2dp($this->user->attestation->params_json['month']['limit'] - $this->user->limits_json['month']['limit']),
                "balance_limit" => Helper::roundTo2dp($this->user->attestation->params_json['balance']['limit'] - $this->balance),
            ],
        ];
    }
}
