<?php

namespace App\Http\Requests\Backend\Web\Currency\CurrencyRate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrencyRateRequest extends FormRequest
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
            'value_sell' => 'required|numeric',
            'value_buy' => 'required|numeric',
            'currency_id' => 'required|alpha_dash',
            'currency_rate_category_id' => 'required|alpha_dash',

        ];
    }
}
