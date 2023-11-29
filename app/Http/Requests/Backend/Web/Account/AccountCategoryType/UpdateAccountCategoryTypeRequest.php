<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 16.07.2019
 * Time: 11:35
 */

namespace App\Http\Requests\Backend\Web\Account\AccountCategoryType;


use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountCategoryTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:account_category_types,name,' . $this->type,
            'img_uncolored' => 'max:155',
            'img_colored' => 'max:155',
            'position' => 'required|alpha_dash|unique:account_category_types,position,' . $this->type,
            'params_json' => 'nullable|string',
        ];
    }
}