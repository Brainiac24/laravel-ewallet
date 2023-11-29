<?php

namespace App\Http\Requests\Backend\Web\Account\AccountType;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountTypeRequest extends FormRequest
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
            'code_map' => 'required|max:255|unique:account_types,code_map',
            'name' => 'required|max:255',
            'parent_id' => 'required|alpha_dash',
            'gateway_id' => 'required|alpha_dash',
            'img_uncolored' => 'string|nullable',
            'icon_file' => 'image|max:2048|nullable',
            'params_json' => 'nullable|string',
            'account_category_type_id' =>'required|string',
            'is_exclude_for_fill' =>'nullable|integer',
            'is_show_menu_block_unblock' => 'nullable|integer',
            'is_autocheck_balance' => 'nullable|integer'
        ];
    }
}
