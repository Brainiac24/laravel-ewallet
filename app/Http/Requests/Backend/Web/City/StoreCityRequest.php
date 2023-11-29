<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.03.2019
 * Time: 14:00
 */

namespace App\Http\Requests\Backend\Web\City;


use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:areas,code',
            'code_map' => 'required|alpha_dash|unique:areas,code_map',
            'name' => 'required|unique:areas,name|max:255',
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash',
            'area_id' => 'required|alpha_dash',
            'region_id' => 'required|alpha_dash',
        ];
    }
}