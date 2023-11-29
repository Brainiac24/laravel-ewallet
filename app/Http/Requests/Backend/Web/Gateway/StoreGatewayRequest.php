<?php

namespace App\Http\Requests\Backend\Web\Gateway;

use Illuminate\Foundation\Http\FormRequest;

class StoreGatewayRequest extends FormRequest
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
            'code' => 'required|max:255|unique:gateways,code',
            'name' => 'required|max:255',
            'params_json' => 'string|nullable',
            'is_enabled_for_account' => 'required|numeric',
            'is_enabled_for_service' => 'required|numeric',
            'is_active' => 'required|numeric',
        ];
    }
}
