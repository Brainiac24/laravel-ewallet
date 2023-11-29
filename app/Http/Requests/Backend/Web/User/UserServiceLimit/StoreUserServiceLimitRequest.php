<?php

namespace App\Http\Requests\Backend\Web\User\UserServiceLimit;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserServiceLimitRequest extends FormRequest
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
            'service_id' => 'required|alpha_dash',
            'user_id' => 'required|alpha_dash',
            'params_json' => 'required|string',
        ];
    }
}