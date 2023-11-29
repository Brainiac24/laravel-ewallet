<?php

namespace App\Http\Requests\Backend\Web\Order\OrderCardContractType;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderCardContractTypeRequest extends FormRequest
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
            'code_map' =>'required|string|unique:order_card_contract_types,code_map,'.$this->cardContractType,
            'name' => 'required|string|min:5',
            'percentage' => 'nullable|integer',
            'month' => 'nullable|integer',
            'is_active' => 'required|boolean'
        ];
    }
}
