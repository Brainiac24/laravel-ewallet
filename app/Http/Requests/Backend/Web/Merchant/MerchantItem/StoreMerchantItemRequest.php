<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 04.11.2019
 * Time: 15:00
 */

namespace App\Http\Requests\Backend\Web\Merchant\MerchantItem;


use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantItemRequest extends FormRequest
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
            'name' => 'required|max:255',
            'phone' => 'required|string',
            'address' => 'max:255',
            'email' => 'max:255',
//            'account_number' => 'required|max:50',
            'merchant_id' => 'required|string',
//            'account_id' => 'alpha_dash',
            'is_active' => 'required|alpha_dash',
        ];
    }
}