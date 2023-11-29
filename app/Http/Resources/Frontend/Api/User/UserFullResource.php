<?php

namespace App\Http\Resources\Frontend\Api\User;

use Illuminate\Http\Resources\Json\Resource;

class UserFullResource extends Resource
{

    public $tempUserRepository = true;
    public $countryRepository;
    public $regionRepository;
    public $areaRepository;
    public $cityRepository;
    public $documentTypeRepository;

    public function toArray($request)
    {
        //dd($this->contacts_json['gender']??-1);

        return [
            'is_verified' => trans('InterfaceTranses.is_verified.' . ($this->verification_params_json['is_verified'] ?? 0)),
            'verify_id' => $this->verification_params_json['id'] ?? '',
            'verify_date' => $this->verification_params_json['verify_date'] ?? '',
            'verify_by_system' => $this->verification_params_json['verify_by_system'] ?? '',
            'document' => [
                [trans('client.backend.table.msisdn'), (string) $this->msisdn ?? ''],
                [trans('client.backend.table.first_name'), (string) $this->first_name ?? ''],
                [trans('client.backend.table.middle_name'), $this->middle_name ?? ''],
                [trans('client.backend.table.last_name'), $this->last_name ?? ''],
                [trans('client.backend.table.inn'), $this->contacts_json['inn'] ?? ''],
                [trans('client.backend.table.email'), $this->email ?? ''],
                [trans('client.backend.table.documentType'), $this->document_type->name ?? ''],
                [trans('client.backend.table.dateOfBirth'), $this->contacts_json['date_birth'] ?? ''],
                [trans('client.backend.table.gender'), trans('InterfaceTranses.gender.' . $this->contacts_json['gender']) ?? ''],
                [trans('client.backend.table.passport'), $this->contacts_json['passport'] ?? ''],
                [trans('client.backend.table.passport_issued_by'), $this->contacts_json['passport_issued_by'] ?? ''],
                [trans('client.backend.table.citizenship'), $this->country->name ?? ''],
                [trans('client.backend.table.region'), $this->region->name ?? ''],
                [trans('client.backend.table.area'), $this->area->name ?? ''],
                [trans('client.backend.table.city'), $this->city->name ?? ''],
                [trans('client.backend.table.street'), $this->contacts_json['street'] ?? ''],
                [trans('client.backend.table.house'), $this->contacts_json['house'] ?? ''],
                [trans('client.backend.table.flat'), $this->contacts_json['flat'] ?? ''],
                [trans('client.backend.table.placeOfBirth'), $this->country_born->name ?? ''],
                [trans('client.backend.table.documentCreateDate'), $this->contacts_json['documentCreateDate'] ?? ''],
            ],
        ];
    }
}
