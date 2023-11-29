<?php

namespace App\Http\Resources\Frontend\Api\User\Attestation;

use App\Services\Common\Helpers\Helper;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class AttestationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'name' => $this->name,
            'code' => $this->code,
            'day_limit' => Helper::roundTo2dp($this->params_json['day']['limit']),
            'week_limit' => Helper::roundTo2dp($this->params_json['week']['limit']),
            'month_limit' => Helper::roundTo2dp($this->params_json['month']['limit']),
            'balance_limit' => Helper::roundTo2dp( $this->params_json['balance']['limit']),
        ];

        if (Auth::user()->attestation_id == $this->id) {
            $data['is_active'] =  1;
            $data['used_limit'] = Auth::user()->limits_json;
            //dd(Auth::user());
        } 

        return $data;
    }
}
