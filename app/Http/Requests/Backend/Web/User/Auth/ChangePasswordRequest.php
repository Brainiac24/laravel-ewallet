<?php

namespace App\Http\Requests\Backend\Web\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password'      => 'required|current_password_match',
            'new_password'          => 'required|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|min:8|confirmed|different:current_password',
            'new_password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'new_password.regex' => 'Пароль должен содержать только латинские буквы, буквы верхнего регистра, буквы нижнего регистра, цифры, символи и длина не менее 8',
        ];
    }

    public function attributes()
    {
        return [
            "current_password" => trans('profile.backend.current_password'),
            "new_password" => trans('profile.backend.new_password'),
            "new_password_confirmation" => trans('profile.backend.new_password_confirmation'),
        ];
    }
}
