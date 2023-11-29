<?php

namespace App\Http\Requests\Backend\Web\Account\Account;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
            'number' => 'required|max:255|unique:accounts,number',
            'balance' => 'required|max:255',
            'blocked_balance' => 'required|alpha_dash',
            'account_type_id' => 'required|alpha_dash',
            'user_id' => 'required|alpha_dash',
            'currency_id' => 'required|alpha_dash',
        ];
    }
}
