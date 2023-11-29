<?php

namespace App\Http\Requests\Backend\Web\Account\AccountTypeDetail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountTypeDetailRequest extends FormRequest
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
            'code' => 'required|max:255|unique:account_types,code,'.$this->types_detail,
            'name' => 'required|max:255',
            'account_type_id' => 'required|alpha_dash',
        ];
    }
}
