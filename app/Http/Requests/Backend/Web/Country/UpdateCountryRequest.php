<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 28.02.2019
 * Time: 16:48
 */

namespace App\Http\Requests\Backend\Web\Country;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:countries,code,'.$this->country,
            'code_map' => 'required|alpha_dash|unique:countries,code_map,'.$this->country,
            'name' => 'required|max:255|unique:countries,name,'.$this->country,
            'iso_2' => 'max:2',
            'iso_3' => 'max:3',
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash'
        ];
    }
}