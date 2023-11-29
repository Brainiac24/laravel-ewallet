<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.03.2019
 * Time: 17:28
 */

namespace App\Http\Requests\Backend\Web\Region;


use Illuminate\Foundation\Http\FormRequest;

class StoreRegionRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:regions,code',
            'code_map' => 'required|alpha_dash|unique:regions,code_map',
            'name' => 'required|unique:regions,name|max:255',
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash',
            'country_id' => 'required|alpha_dash',
        ];
    }
}