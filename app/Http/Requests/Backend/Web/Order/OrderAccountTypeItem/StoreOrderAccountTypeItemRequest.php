<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.07.2019
 * Time: 9:30
 */

namespace App\Http\Requests\Backend\Web\Order\OrderAccountTypeItem;


use Illuminate\Foundation\Http\FormRequest;

class StoreOrderAccountTypeItemRequest extends FormRequest
{
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
            'code' => 'required|string',
            'code_map' => 'required|string|unique:order_card_types,code_map',
            'name' => 'required|string',
            'currency_id' => 'required|alpha_dash',
            'order_account_type_id' => 'required|alpha_dash',
            'position' => 'required|numeric',
            'is_active' => 'required|numeric',
        ];
    }
}