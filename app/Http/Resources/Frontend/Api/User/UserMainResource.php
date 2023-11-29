<?php

namespace App\Http\Resources\Frontend\Api\User;

use App\Http\Resources\Frontend\Api\Account\AccountBalanceResource;
use App\Services\Common\Helpers\Service;
use Illuminate\Http\Resources\Json\Resource;

class UserMainResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this->contacts_json['gender']??-1);

        return [
            'photo_url' => $this->photo,
            'msisdn' => $this->msisdn,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'date_birth' => $this->contacts_json['date_birth']??null,
            'gender' => (int)($this->contacts_json['gender']??-1),
            'username' => $this->username,
            'email' => $this->email,
            'attestation_name' => $this->attestation->name,
            'qr_code' => $this->qr,
            'accounts' => AccountBalanceResource::collection($this->accounts),
        ];
    }
}
