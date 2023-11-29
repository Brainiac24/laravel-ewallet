<?php

namespace App\Http\Requests\Backend\Web\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|max:255|unique:users,username,'.$this->user,
//            'msisdn' => 'required|max:255|unique:users,msisdn,'.$this->user,
            'first_name' => 'required|max:255|string',
            'middle_name' => 'required|max:255|string',
            'last_name' => 'max:255|string|nullable',
//            'description' => 'required|max:255|string',
            'password' => 'nullable|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|min:8|confirmed',
            'password_confirmation' => 'nullable|max:255',
            'roles_id'=>'required|array|min:1',
            'roles_id.*'=>'required|alpha_dash',
            'branches_id.*'=>'alpha_dash',
            'is_active'=>'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Пароль должен содержать только латинские буквы, буквы верхнего регистра, буквы нижнего регистра, цифры, символи и длина не менее 8',
        ];
    }
}
