<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.03.2019
 * Time: 13:24
 */

namespace App\Http\Requests\Backend\Web\City;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:cities,code,'.$this->city,
            'code_map' => 'required|alpha_dash|unique:cities,code_map,'.$this->city,
            'name' => 'required|max:255|unique:cities,name,'.$this->city,
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash',
            'area_id' => 'required|alpha_dash',
            'region_id' => 'required|alpha_dash',
        ];
    }
}