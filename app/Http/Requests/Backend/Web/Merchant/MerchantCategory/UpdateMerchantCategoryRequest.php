<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 10:47
 */

namespace App\Http\Requests\Backend\Web\Merchant\MerchantCategory;


use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'is_active' => 'required|alpha_dash'
        ];
    }
}