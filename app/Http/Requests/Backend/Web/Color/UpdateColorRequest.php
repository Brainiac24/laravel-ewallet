<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.07.2019
 * Time: 16:56
 */

namespace App\Http\Requests\Backend\Web\Color;


use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

     public function rules()
    {
        return [
            'code' => 'required|max:255|unique:colors,code,'.$this->id,
            'color' => 'required|max:255|unique:colors,color,'.$this->id,
            'is_active' => 'required|alpha_dash',
        ];
    }
}