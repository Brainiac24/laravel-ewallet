<?php

namespace App\Http\Requests\Backend\Web\Currency;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:currencies,code',
            'name' => 'required|max:255',
            'short_name' => 'required|max:255',
            'iso_name' => 'required|max:255',
            'symbol_left' => 'max:20',
            'symbol_right' => 'max:20',
            'is_primary' => 'required|alpha_dash',
            'is_active' => 'required|alpha_dash',
        ];
    }
}
