<?php

namespace App\Http\Requests\Backend\Web\User\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpadateLiteRequest extends FormRequest
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
