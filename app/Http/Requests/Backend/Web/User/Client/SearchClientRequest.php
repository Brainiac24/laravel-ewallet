<?php

namespace App\Http\Requests\Backend\Web\User\Client;

use Illuminate\Foundation\Http\FormRequest;

class SearchClientRequest extends FormRequest
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
            'msisdn' => 'numeric|nullable',
            'full_name' => 'string|nullable',
            'from_date' => 'date|nullable',
            'to_date' => 'date|nullable|after_or_equal:from_date',
            'code_map' => 'string|nullable',
            'devices_json' => 'string|nullable',
            'attestation_id' => 'string|nullable',
            'export' => 'string|nullable',
        ];
    }
}
