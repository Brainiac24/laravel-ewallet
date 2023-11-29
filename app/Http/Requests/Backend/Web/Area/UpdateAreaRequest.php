<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.03.2019
 * Time: 9:32
 */

namespace App\Http\Requests\Backend\Web\Area;


use Illuminate\Foundation\Http\FormRequest;

class UpdateAreaRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:areas,code,'.$this->area,
            'code_map' => 'required|alpha_dash|unique:areas,code_map,'.$this->area,
            'name' => 'required|max:255|unique:areas,name,'.$this->area,
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash',
            'region_id' => 'required|alpha_dash',
        ];
    }
}