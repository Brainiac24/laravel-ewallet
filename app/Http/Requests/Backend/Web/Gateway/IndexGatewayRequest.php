<?php

namespace App\Http\Requests\Backend\Web\Gateway;

use Illuminate\Foundation\Http\FormRequest;

class IndexGatewayRequest extends FormRequest
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

    public function rules()
    {
        return [
            'gateway_name' => 'string|nullable',
            'code' => 'string|nullable',
            'params_json' => 'string|nullable',
            'is_active' => 'numeric|nullable',
            'is_enabled_for_account' => 'numeric|nullable',
            'is_enabled_for_service' => 'numeric|nullable',
        ];
    }
}
