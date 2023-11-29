<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 28.02.2019
 * Time: 15:24
 */

namespace App\Http\Requests\Backend\Web\Country;


use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:countries,code',
            'code_map' => 'required|alpha_dash|unique:countries,code_map',
            'name' => 'required|unique:countries,name|max:255',
            'iso_2' => 'max:2',
            'iso_3' => 'max:3',
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash',
        ];
    }
}