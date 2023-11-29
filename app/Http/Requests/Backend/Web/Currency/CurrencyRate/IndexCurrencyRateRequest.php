<?php

namespace App\Http\Requests\Backend\Web\Currency\CurrencyRate;

use Illuminate\Foundation\Http\FormRequest;

class IndexCurrencyRateRequest extends FormRequest
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
            'code' => 'string|nullable',
            'iso_name' => 'string|nullable',
            'name' => 'string|nullable',
        ];
    }
}
