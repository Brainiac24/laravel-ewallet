<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.07.2019
 * Time: 16:53
 */

namespace App\Http\Requests\Backend\Web\Color;


use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'code' => 'required|alpha_dash|unique:colors,code',
            'color' => 'required|unique:colors,color|max:255',
            'is_active' => 'required|alpha_dash',
        ];
    }
}