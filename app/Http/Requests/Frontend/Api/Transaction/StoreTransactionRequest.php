<?php

namespace App\Http\Requests\Frontend\Api\Transaction;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Frontend\Api\ApiBaseFormRequest;

class StoreTransactionRequest extends ApiBaseFormRequest
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
            'service_id' => 'required|alpha-dash',
            'amount' => 'required|numeric',
            'commission' => 'required|numeric',
            'params' => 'required|array',
            'from_account_number' => 'required|digits:16',
            'add_to_favorite' => 'boolean',
        ];
    }
}
