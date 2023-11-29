<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06.03.2019
 * Time: 17:02
 */

namespace App\Http\Requests\Backend\Web\City;


use Illuminate\Foundation\Http\FormRequest;

class IndexCityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|alpha_dash|',
//            'code_map' => 'required|alpha_dash|unique:areas,code_map,'.$this->area,
//            'name' => 'required|max:255|unique:areas,name,'.$this->area,
//            'desc' => 'max:1055',
//            'is_active' => 'required|alpha_dash',
//            'region_id' => 'required|alpha_dash',
        ];
    }
}