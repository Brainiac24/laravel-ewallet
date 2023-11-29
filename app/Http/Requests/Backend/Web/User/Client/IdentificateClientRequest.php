<?php

namespace App\Http\Requests\Backend\Web\User\Client;

use Illuminate\Foundation\Http\FormRequest;

class IdentificateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'string|required',
            'middle_name' => 'string|required',
            'last_name' => 'string|required',
            'contacts_json.date_birth' => 'date|required',
            'contacts_json.passport' => 'string|regex:/^[A-Za-zА-Яа-яЁё]{1,4}[0-9]{7,12}$/|required',
            'contacts_json.gender' => 'numeric|in:1,0|required',
            'contacts_json.inn' => 'numeric|digits_between:9,11|nullable',
            'contacts_json.passport_issued_by' => 'string|required',
            'document_type_id' => 'alpha_dash|required',
            'country_id' => 'alpha_dash|required',
            'country_born_id' => 'alpha_dash|required',
            'region_id' => 'alpha_dash|required',
            'area_id' => 'alpha_dash|required',
            'city_id' => 'alpha_dash|required',
            'contacts_json.street' => 'string|required',
            'contacts_json.house' => 'string|required',
            'contacts_json.flat' => 'string|nullable',
            'contacts_json.documentCreateDate' => 'date|required',
        ];
    }
}
