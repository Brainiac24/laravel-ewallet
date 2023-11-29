<?php

namespace App\Http\Resources\Frontend\Api\Service;

use App\Http\Resources\Frontend\Api\Account\AccountBalanceResource;
use App\Http\Resources\Frontend\Api\Service\Commission\CommissionResource;
//use App\Http\Resources\Frontend\Api\Service\CommissionData\CommissionDataResource;
use App\Services\Common\Helpers\Helper;
use App\Services\Common\Helpers\Service;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class ServiceResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = Auth::user()->load(['accounts.account_type', 'accounts.currency', 'attestation']);

        $balance = 0;

        //ХАРДКОД возможность ошибки конвертации валюты
        foreach ($user->accounts as $account) {
            if ($account->account_type_id == config('app_settings.default_wallet_account_type_id')) {

                $balance += $account->balance;
            }
        }

        $day_limit = Helper::roundTo2dp($user->attestation->params_json['day']['limit'] - $user->limits_json['day']['limit']);
        $week_limit = Helper::roundTo2dp($user->attestation->params_json['week']['limit'] - $user->limits_json['week']['limit']);
        $month_limit = Helper::roundTo2dp($user->attestation->params_json['month']['limit'] - $user->limits_json['month']['limit']);


        $carbon = new Carbon();

        if ($carbon->parse($user->limits_json['day']['updated_at'])->toDateString() < $carbon->now()->toDateString()) {
            $day_limit = Helper::roundTo2dp($user->attestation->params_json['day']['limit']);
        }
        if ($carbon->parse($user->limits_json['week']['updated_at'])->weekOfYear < $carbon->now()->weekOfYear || $carbon->parse($user->limits_json['week']['updated_at'])->year < $carbon->now()->year) {
            $week_limit = Helper::roundTo2dp($user->attestation->params_json['week']['limit']);
        }
        if ($carbon->parse($user->limits_json['month']['updated_at'])->month < $carbon->now()->month || $carbon->parse($user->limits_json['month']['updated_at'])->year < $carbon->now()->year) {
            $month_limit = Helper::roundTo2dp($user->attestation->params_json['month']['limit']);
        }

        $params = null;

        foreach ($this->params_json as $value) {
            if ($value['input_name'] == 'phone_number' || $value['input_name'] == 'comment' || $value['input_name'] == 'to_account') {
                $params[] = $value;
            }
        }

        //dd($user->accounts);
        return [
            'name' => $this->name,
            'code' => $this->code,
            'type' => config('app_settings.services.type'),
            'currency_iso' => $this->currency->iso_name,
            'min_amount' => Helper::roundTo2dp($this->min_amount),
            'max_amount' => Helper::roundTo2dp($this->max_amount),
            'is_requestable_balance' => empty($this->requestable_balance_params) ? 0 : 1,
            //'workdays'=> new WorkdayResource($this->workday),
            'commissions'=> new CommissionResource($this->commission),
            'params' => $params,
            'accounts' => AccountBalanceResource::collection($user->accounts),
            'current_limits' => [
                "day_limit" =>$day_limit,
                "week_limit" => $week_limit,
                "month_limit" => $month_limit,
                "balance_limit" => Helper::roundTo2dp($user->attestation->params_json['balance']['limit'] - $balance),
            ],
        ];
    }
}
