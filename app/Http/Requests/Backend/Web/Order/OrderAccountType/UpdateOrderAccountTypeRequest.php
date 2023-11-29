<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.07.2019
 * Time: 10:35
 */

namespace App\Http\Requests\Backend\Web\Order\OrderAccountType;


use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderAccountTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|string',
            'code_map' => 'required|string|unique:order_deposit_types,code_map,'.$this->orderDepositType,
            'name' => 'required|string',
            'service_id' => 'required|alpha_dash',
            'icon' => 'required_if:icon_file,' . (null) . '|nullable|string',
            'icon_file' => 'required_if:icon,' . (null) . '|image|max:2048|nullable',
            'position' => 'required|numeric',
            'contract_html' => 'required|string',
            'is_active' => 'required|numeric',
        ];
    }
}