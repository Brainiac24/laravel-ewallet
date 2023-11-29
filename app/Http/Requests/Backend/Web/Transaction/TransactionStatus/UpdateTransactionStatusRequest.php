<?php

namespace App\Http\Requests\Backend\Web\Transaction\TransactionStatus;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionStatusRequest extends FormRequest
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
            'code' => 'required|max:255|unique:transaction_status,code,'.$this->status,
            'name' => 'required|max:255',
            'color' => 'required|max:255',
            'transaction_status_group_id' => 'required|alpha_dash'
        ];
    }
}
