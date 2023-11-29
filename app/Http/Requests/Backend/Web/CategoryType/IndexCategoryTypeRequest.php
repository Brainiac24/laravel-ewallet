<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.07.2019
 * Time: 18:06
 */

namespace App\Http\Requests\Backend\Web\CategoryType;


use Illuminate\Foundation\Http\FormRequest;

class IndexCategoryTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',//'required|alpha_dash',
            'name' => 'string|nullable'//'required|alpha_dash',
        ];
    }
}