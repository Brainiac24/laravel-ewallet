<?php

namespace App\Http\Requests\Backend\Web\Service\ServiceLimits;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceLimitRequest extends FormRequest
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
            'code' => 'required|max:255|unique:service_limits,code',
            'name' => 'required|max:255|unique:service_limits,name',
            'params_json' => 'required|string',
            'extend_params_json' => 'required|string',
            ];
    }
}
