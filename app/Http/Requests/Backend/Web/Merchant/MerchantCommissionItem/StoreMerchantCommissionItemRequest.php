<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 13:55
 */

namespace App\Http\Requests\Backend\Web\Merchant\MerchantCommissionItem;


use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantCommissionItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'value' => 'required|numeric',
            'merchant_commission_id' => 'string|nullable',
            'is_percentage' => 'required|alpha_dash',
//            'is_active' => 'required|alpha_dash'
        ];
    }
}