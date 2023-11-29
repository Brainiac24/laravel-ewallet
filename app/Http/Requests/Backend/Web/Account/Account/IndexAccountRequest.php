<?php

namespace App\Http\Requests\Backend\Web\Account\Account;

use Illuminate\Foundation\Http\FormRequest;

class IndexAccountRequest extends FormRequest
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
            'number' => 'numeric|nullable',
            'account_type_id' => 'alpha_dash|nullable',
            'full_name' => 'string|nullable',
            'msisdn' => 'numeric|nullable',
            'account_status_id' => 'alpha_dash|nullable',
            'currency_id' => 'alpha_dash|nullable'
        ];
    }
}
