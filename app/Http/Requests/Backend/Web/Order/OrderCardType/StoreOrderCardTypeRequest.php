<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.07.2019
 * Time: 9:30
 */

namespace App\Http\Requests\Backend\Web\Order\OrderCardType;


use Illuminate\Foundation\Http\FormRequest;

class StoreOrderCardTypeRequest extends FormRequest
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
        'price' => 'required|numeric',
        'insurance_price' => 'required|numeric',
        'code_ibank' => 'required|numeric',
        'year' => 'required|numeric',
        'icon' => 'required_if:icon_file,'.(null).'|nullable|string',
        'information' => 'nullable|string',
        'detail' => 'nullable|string',
        'position' => 'required|numeric',
        'currency_id' => 'required|alpha_dash',
        'params_json' => 'required|string',
        'order_card_contract_type_id' => 'required|alpha_dash',
        'is_active' => 'required|numeric',
            'icon_file' => 'required_if:icon,'.(null).'|image|max:2048|nullable',
        ];
    }
}