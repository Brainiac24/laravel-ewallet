<?php

namespace App\Http\Requests\Backend\Web\Account\AccountTypeDetail;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountTypeDetailRequest extends FormRequest
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
            'code' => 'required|max:255|unique:account_types,code',
            'name' => 'required|max:255',
            'parent_id' => 'required|alpha_dash',
            'account_type_id' => 'required|alpha_dash',
        ];
    }
}
