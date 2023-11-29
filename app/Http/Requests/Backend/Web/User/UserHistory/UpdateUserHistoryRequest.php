<?php

namespace App\Http\Requests\Backend\Web\User\UserHistory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserHistoryRequest extends FormRequest
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
            'username' => 'required|max:255|unique:user_histories,username,'.$this->username,
            'msisdn' => 'required|max:255|unique:user_histories,msisdn,'.$this->msisdn,
            'email' => 'max:255',
            'password' => 'max:255',
            'remember_token' => 'required|numeric',
            'attestation_id' => 'required|numeric',
            'limits_json' => 'required|max:1000',
            'contacts_json' => 'required|max:1000',
        ];
    }
}
