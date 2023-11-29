<?php

namespace App\Http\Requests\Backend\Web\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'code' => 'required|max:255|unique:services,code,'.$this->service,
            'code_map' => 'required|string',
//            'code_map' => 'required|max:255|unique:services,code_map,'.$this->service,
            'processing_code' => 'required|max:255|unique:services,processing_code,'.$this->service,
            'name' => 'required|max:255|unique:services,name,'.$this->service,
            'icon_url' => 'image|max:2048|nullable',
            'in_icon_url' => 'image|max:2048|nullable',
            'out_icon_url' => 'image|max:2048|nullable',
            'params_json' => 'nullable|string',
            'min_amount' => 'numeric',
            'max_amount' => 'numeric',
            'is_active' => 'digits_between:0,1',
            'is_enabled' => 'digits_between:0,1',
            'requestable_balance_params' => 'nullable|string',
            'is_to_accountable' => 'digits_between:0,1',
            'position' => 'required|numeric',
            'service_limit_id' => 'nullable|alpha_dash',
            'service_otp_limit_id' => 'nullable|alpha_dash',
            'gateway_id' => 'required|alpha_dash',
            'workday_id' => 'nullable|alpha_dash',
            'commission_id' => 'nullable|alpha_dash',
            'currency_id' => 'required|alpha_dash',
            'currency_rate_category_id' => 'required|alpha_dash',
            'extend_params_json' => 'nullable|string',
            'add_to_favorite' => 'required|alpha_dash',
            'is_checkable' => 'required|alpha_dash',
        ];
    }
}
