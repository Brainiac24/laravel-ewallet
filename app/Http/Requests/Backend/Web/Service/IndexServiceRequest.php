<?php

namespace App\Http\Requests\Backend\Web\Service;

use Illuminate\Foundation\Http\FormRequest;

class IndexServiceRequest extends FormRequest
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
            'code' => 'string|nullable',
            'processing_code' => 'string|nullable',
            'name' => 'string|nullable',
            'params_json' => 'string|nullable',
            'gateway_id' => 'alpha_dash|nullable',
            'currency_id' => 'alpha_dash|nullable',
            'workday_id' => 'alpha_dash|nullable',
            'is_active'=>'numeric|nullable',
            'is_checkable'=>'numeric|nullable',
        ];
    }
}
