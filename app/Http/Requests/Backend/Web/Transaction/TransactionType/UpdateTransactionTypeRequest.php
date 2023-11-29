<?php

namespace App\Http\Requests\Backend\Web\Transaction\TransactionType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionTypeRequest extends FormRequest
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
            'code' => 'required|max:255|unique:transaction_types,code,'.$this->type,
            'name' => 'required|max:255',

        ];
    }
}
