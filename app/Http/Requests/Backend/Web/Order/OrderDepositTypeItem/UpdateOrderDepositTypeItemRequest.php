<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.07.2019
 * Time: 10:35
 */

namespace App\Http\Requests\Backend\Web\Order\OrderDepositTypeItem;


use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderDepositTypeItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|string',
            'code_map' => 'required|string|unique:order_card_types,code_map',
            'name' => 'required|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'day_from_count' => 'required|numeric',
            'day_to_count' => 'required|numeric',
            'percentage' => 'required|numeric',
            'can_fill_until' => 'required|numeric',
            'can_fill_until_is_persentage' => 'required|numeric',
            'currency_id' => 'required|alpha_dash',
            'order_deposit_type_id' => 'required|alpha_dash',
            'position' => 'required|numeric',
            'is_fillable' => 'required|boolean',
            'is_withdrawable' => 'required|boolean',
            'is_active' => 'required|numeric',
            ];
    }
}