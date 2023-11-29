<?php

namespace App\Http\Requests\Backend\Web\User\UserServiceLimit;

use Illuminate\Foundation\Http\FormRequest;

class IndexUserServiceLimitRequest extends FormRequest
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
            'name' => 'string|nullable',
            'msisdn' => 'numeric|nullable',
            'full_name' => 'string|nullable',
            'params_json' => 'string|nullable',
            'service_id' => 'alpha_dash|nullable',
        ];
    }
}
