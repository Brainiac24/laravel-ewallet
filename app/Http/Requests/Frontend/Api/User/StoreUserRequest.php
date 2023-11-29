<?php

namespace App\Http\Requests\Frontend\Api\User;

use App\Http\Requests\Frontend\Api\ApiBaseFormRequest;

class StoreUserRequest extends ApiBaseFormRequest
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
            'username' => 'required|max:50|unique:users,username',
            'email' => 'sometimes|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ];
    }
}
