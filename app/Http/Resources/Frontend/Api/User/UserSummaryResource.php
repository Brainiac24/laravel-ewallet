<?php

namespace App\Http\Resources\Frontend\Api\User;

use App\Http\Resources\Frontend\Api\Account\AccountBalanceResource;
use App\Services\Common\Helpers\Service;
use Illuminate\Http\Resources\Json\Resource;

class UserSummaryResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'photo_url' => '',
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'attestation_name' => $this->attestation->name,
            'msisdn' => $this->msisdn,
            'qr_code' => $this->qr,
            'accounts' => AccountBalanceResource::collection($this->accounts),
        ];
    }
}
