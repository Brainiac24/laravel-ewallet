<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.03.2019
 * Time: 16:33
 */

namespace App\Http\Requests\Backend\Web\Region;


use Illuminate\Foundation\Http\FormRequest;

class UpdateRegionRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:regions,code,'.$this->region,
            'code_map' => 'required|alpha_dash|unique:regions,code_map,'.$this->region,
            'name' => 'required|max:255|unique:regions,name,'.$this->region,
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash',
            'country_id' => 'required|alpha_dash',
        ];
    }
}