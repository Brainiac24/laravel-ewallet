<?php

namespace App\Http\Requests\Frontend\Api\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmSmsTransactionRequest extends FormRequest
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
            'hash_code' => 'required|alpha_num',
            'transaction_id' => 'required|alpha-dash',
        ];
    }
}
