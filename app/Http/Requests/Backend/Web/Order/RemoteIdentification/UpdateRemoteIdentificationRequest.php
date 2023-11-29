<?php

namespace App\Http\Requests\Backend\Web\Order\RemoteIdentification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRemoteIdentificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile.first_name' => 'required',
            'profile.last_name' => 'required',
            'profile.birth_date' => 'required|date',
            'profile.gender_id' => 'required',
            'profile.inn' => 'required',
            'profile.citizenship_id' => 'required',
            'profile.document_type_id' => 'required',
            'profile.passport_seria' => 'required',
            'profile.passport_number' => 'required',
            'profile.passport_issue_date' => 'required|date',
            'profile.passport_by_who' => 'required',
            'profile.country_id' => 'required',
            'profile.region_id' => 'required',
            'profile.district_id' => 'required',
            'profile.city_id' => 'required',
            'profile.street' => 'required',
            'profile.house_number' => 'required',
            'profile.registration_date' => 'required_if:profile.registration_date_not,0|date|nullable',
            'profile.is_resident' => 'required',
            'profile.document_expiration_date' => 'required_if:profile.document_expiration_date_not,0|date|nullable',
        ];
    }

    public function attributes()
    {
        return [
            'profile.first_name' => trans("remoteIdentification.backend.first_name"),
            'profile.last_name' => trans("remoteIdentification.backend.last_name"),
            'profile.birth_date' => trans("remoteIdentification.backend.birth_date"),
            'profile.gender_id' => trans("remoteIdentification.backend.gender"),
            'profile.inn' => trans("remoteIdentification.backend.inn"),
            'profile.citizenship_id' => trans("remoteIdentification.backend.table.citizenship"),
            'profile.document_type_id' => trans("remoteIdentification.backend.document_type"),
            'profile.passport_seria' => "Серия паспорта",
            'profile.passport_number' => "Номер паспорта",
            'profile.passport_issue_date' => trans("remoteIdentification.backend.passport_issue_date"),
            'profile.passport_by_who' => trans("remoteIdentification.backend.passport_by_who"),
            'profile.country_id' => trans("remoteIdentification.backend.country_id"),
            'profile.region_id' => trans("remoteIdentification.backend.region_id"),
            'profile.district_id' => trans("remoteIdentification.backend.district_id"),
            'profile.city_id' => trans("remoteIdentification.backend.city_id"),
            'profile.street' => trans("remoteIdentification.backend.street"),
            'profile.house_number' => trans("remoteIdentification.backend.house_number"),
            'profile.registration_date' => trans("remoteIdentification.backend.registration_date"),
            'profile.is_resident' => trans("remoteIdentification.backend.resident"),
            'profile.document_expiration_date' => trans("remoteIdentification.backend.document_expiration_date"),
        ];
    }

    public function messages()
    {
        return [
            "profile.document_expiration_date.required_if" => "Поле Действитилен до обязательно для заполнения",
            "profile.registration_date.required_if" => "Поле Дата регистрации прописки обязательно для заполнения",

        ];
    }
}